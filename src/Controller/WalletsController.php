<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Database\Expression\QueryExpression;

use Cake\ORM\Query;

/**
 * Wallets Controller
 *
 *
 * @method \App\Model\Entity\Wallet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WalletsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow(['index', 'create', 'view']);
    }
    
    public function isAuthorized($user)
    {
        $this->loadModel('CryptoWallets');
        
        $action = $this->request->getParam('action');
        // The 'index', 'create', actions are always allowed to logged in users.
        if (in_array($action, ['index', 'create'])) {
            return true;
        }

        // All other actions require a wallet_id.
        $wallet_id = $this->request->getParam('pass.0');
        if (!$wallet_id) {
            return false;
        }

        // Check that the wallet belongs to the current user.
        $wallet = $this->CryptoWallets->findById($wallet_id)->first();
        
        if(empty($wallet)) return false;

        return $wallet->customer_user_id === $user['id'];
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($wallet_id = null)
    {
        $this->loadModel('CryptoWallets');
        
        
        $customer_user_id = $this->Auth->user('id');
        
        if(empty($wallet_id)){
            $value_card_auth = $this->request->getSession()->read('ValueCardAuth');
            if($value_card_auth){
                $wallet_id = $value_card_auth['wallet_id'];
            }
        }
        
        $cryptoWallet = null;
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => []
            ]);
        }
        
        $wallets = null;
        
        if ($this->request->is('post')) {
            $filter = $this->request->getData();
            
            $query = $this->CryptoWallets->find();
            
            if(isset($filter['wallet_address']) && !empty($filter['wallet_address'])){
                $query->where(['customer_user_id' => $customer_user_id]);
                $query->where([
                    'OR' => [
                        ['wallet_label like' => '%' . $filter['wallet_address'] . '%'], 
                        ['wallet_address like' => '%' . $filter['wallet_address'] . '%']
                    ],
                ]);
            }
            if(isset($filter['crypto_currency_id']) && !empty($filter['crypto_currency_id'])){
                $query->where(['crypto_currency_id' => $filter['crypto_currency_id']]);
            }

            $wallets = $this->paginate($query);
            

        }else{
            
            $query = $this->CryptoWallets->find();
            $query->where(['customer_user_id' => $customer_user_id]);
            
            $wallets = $this->paginate($query);
        }
        
        
        
        $cryptoCurrencies = $this->CryptoWallets->CryptoCurrencies->find('list', ['limit' => 200]);

        $this->set(compact('wallets', 'cryptoCurrencies', 'customer_user_id', 'cryptoWallet'));
    }

    /**
     * View method
     *
     * @param string|null $id Wallet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($wallet_id = null)
    {
        
        $customer_user_id = $this->Auth->user('id');
        
        if(empty($wallet_id)){
            $value_card_auth = $this->request->getSession()->read('ValueCardAuth');
            if($value_card_auth){
                $wallet_id = $value_card_auth['wallet_id'];
            }
        }
        
        $this->loadModel('CryptoWallets');
        
        $cryptoWallet = null;
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => []
            ]);
        }

        $this->set('cryptoWallet', $cryptoWallet);
        $this->set('customer_user_id', $customer_user_id);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function create()
    {
        $this->loadModel('CryptoWallets');
        
        $customer_user_id = $this->Auth->user('id');
        
        $wallet = $this->CryptoWallets->newEntity();
        if ($this->request->is('post')) {
            $wallet = $this->CryptoWallets->patchEntity($wallet, $this->request->getData());
            
            $wallet->customer_user_id = $this->Auth->user('id');
            
            if ($this->CryptoWallets->save($wallet)) {
                $this->Flash->success(__('The wallet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
        }
        
        $cryptoCurrencies = $this->CryptoWallets->CryptoCurrencies->find('list', ['limit' => 200]);
        
        $this->set(compact('wallet', 'cryptoCurrencies', 'customer_user_id'));
    }

    
}
