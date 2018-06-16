<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Database\Expression\QueryExpression;

use Cake\ORM\Query;

use Web3Service\Controller\AppController as Web3Controller;

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

        $wallet = $this->CryptoWallets->newEntity();

        if(empty($wallet_id)){
            $value_card_auth = $this->request->getSession()->read('ValueCardAuth');
            if($value_card_auth){
                $wallet_id = $value_card_auth['wallet_id'];
            }
        }

        $cryptoWallet = null;
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => ['CryptoCurrencies'],
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id]
            ]);
        }

        $wallets = null;

        if ($this->request->is('post')) {
            $filter = $this->request->getData();

            $query = $this->CryptoWallets->find()->contain([
                'CryptoCurrencies'
            ]);
            $query->where(['customer_user_id' => $customer_user_id]);
            if(isset($filter['wallet_address']) && !empty($filter['wallet_address'])){
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
            
            $query = $this->CryptoWallets->find()->contain([
                'CryptoCurrencies'
            ]);
            $query->where(['customer_user_id' => $customer_user_id]);
            
            $wallets = $this->paginate($query);
        }
        $conditions = array('is_active'=>true);
        $cryptoCurrencies = $this->CryptoWallets->CryptoCurrencies->find('list', ['keyField' => 'id', 'valueField' => 'currency_unit_label', 
            'conditions'=>$conditions, 'limit' => 200]);

        $this->set(compact('wallets', 'cryptoCurrencies', 'customer_user_id', 'cryptoWallet', 'wallet'));
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
                'contain' => ['CryptoCurrencies'],
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id]
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

        $this->loadComponent('AccountUser');

        $customer_user_id = $this->Auth->user('id');

        $wallet = $this->CryptoWallets->newEntity();

        if ($this->request->is('post')) {
            $request_data = $this->request->getData(); //TODO: validate first the request data

            //$wallet = $this->CryptoWallets->patchEntity($wallet, $this->request->getData());
            /**
            $wallet = $this->CryptoWallets->newEntity($request_data);
            $wallet->customer_user_id = $customer_user_id;

            if ($this->CryptoWallets->save($wallet)) {
                $this->Flash->success(__('The wallet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            */

            $password_crypt = $request_data['password_crypt']; //TODO: create mechanism to verify the password

            $result_wallet = null;

            if(isset($request_data['crypto_currency_id'])){

                $crypto_currency = $this->CryptoWallets->CryptoCurrencies->findById($request_data['crypto_currency_id'])->first();

                if($crypto_currency){

                    $crypto_currency_name = $crypto_currency->currency_unit_label;
                    if($crypto_currency_name == 'Varatto') $crypto_currency_name = 'Web3Service';

                    $crypto_currency_name_component = $crypto_currency_name . '.Account';

                    $this->loadComponent($crypto_currency_name_component);

                    $result_wallet  = $this->Account->create($password_crypt);

                    if($result_wallet['status']==Web3Controller::WEB3_STATUS_SUCCESS){
                        $wallet_address = $result_wallet['wallet_address'];
                        $crypto_currency_id = $result_wallet['crypto_currency_id'];
                        $wallet_label = $request_data['wallet_label'];
                        $this->AccountUser->newWallet($customer_user_id, $wallet_address, $crypto_currency_id, $wallet_label);
                    }
                }
            }

            if(empty($result_wallet)){
                $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
            }else if($result_wallet['status']==Web3Controller::WEB3_STATUS_SUCCESS) {
                $this->Flash->success(__('New wallet has been created.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
        }
        $conditions = array('is_active'=>true);
        $cryptoCurrencies = $this->CryptoWallets->CryptoCurrencies->find('list', ['keyField' => 'id', 'valueField' => 'currency_unit_label', 
            'conditions'=>$conditions, 'limit' => 200]);
        $this->set(compact('wallet', 'cryptoCurrencies', 'customer_user_id'));
    }

    public function confirmEmail($token)
    {
        
    }

    
}
