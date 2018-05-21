<?php
namespace App\Controller;

use App\Controller\AppController;

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

        // All other actions require a slug.
        $wallet_address = $this->request->getParam('pass.0');
        if (!$wallet_address) {
            return false;
        }

        // Check that the wallet belongs to the current user.
        $wallet = $this->CryptoWallets->findByWalletAddress($wallet_address)->first();

        return $wallet->customer_user_id === $user['id'];
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('CryptoWallets');
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $wallets = $this->paginate($this->CryptoWallets);

        $this->set(compact('wallets', 'customer_user_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Wallet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('CryptoWallets');
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $wallet = $this->CryptoWallets->get($id, [
            'contain' => []
        ]);

        $this->set('wallet', $wallet);
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
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
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
