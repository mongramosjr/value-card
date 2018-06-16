<?php
namespace App\Controller;

use App\Controller\AppController;

use Web3Service\Controller\AppController as Web3Controller;


/**
 * PaymentTransactions Controller
 *
 * @property \App\Model\Table\PaymentTransactionsTable $CryptoTransactions
 *
 * @method \App\Model\Entity\PaymentTransaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentTransactionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow(['logout', 'signup']);
    }
    
    public function isAuthorized($user)
    {
        $this->loadModel('CryptoTransactions');
        
        $action = $this->request->getParam('action');
        // The ''view', 'changePassword' actions are always allowed to logged in users.
        if (in_array($action, ['send', 'receive', 'index', 'view'])) {
            return true;
        }

        // All other actions require a transaction_id.
        $crypto_transaction_id = $this->request->getParam('pass.0');
        if (!$crypto_transaction_id) {
            return false;
        }

        // Check that the wallet belongs to the current user.
        $crypto_transaction = $this->CryptoTransactions->findById($crypto_transaction_id)->first();
        
        if(empty($crypto_transaction)) return false;

        return $crypto_transaction->customer_user_id === $user['id'];
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($wallet_id = null)
    {
        $this->loadModel('CryptoTransactions');
        
        $this->loadModel('CryptoWallets');
        
        
        
        $customer_user_id = $this->Auth->user('id');
        
        
        
        $this->paginate = [
            'contain' => ['CustomerUsers', 'Currencies', 'CryptoCurrencies']
        ];
        
        if(!empty($wallet_id)){
            
            
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => []
            ]);
            
            $query = $this->CryptoTransactions->find();
            $query->where(['customer_user_id' => $customer_user_id]);
            
            if($cryptoWallet){
                $query->where([
                    'OR' => [
                        ['source_wallet_address' => $cryptoWallet->wallet_address], 
                        ['target_wallet_address' => $cryptoWallet->wallet_address]
                    ],
                ]);
            }
            
            $cryptoTransactions = $this->paginate($query);
            
            
        }else{
            $query = $this->CryptoTransactions->find();
            $query->where(['customer_user_id' => $customer_user_id]);
            
            $cryptoTransactions = $this->paginate($query);
        }
        
        $cryptoWallet =null;
        
        if(empty($wallet_id)){
            $value_card_auth = $this->request->getSession()->read('ValueCardAuth');
            if($value_card_auth){
                $wallet_id = $value_card_auth['wallet_id'];
            }
        }
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id]
            ]);
        }

        $this->set(compact('cryptoTransactions', 'customer_user_id', 'cryptoWallet'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment Transaction id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($transaction_id, $wallet_id = null)
    {
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->get($transaction_id, [
            'contain' => ['CustomerUsers', 'Currencies', 'CryptoCurrencies']
        ]);
        
        $this->loadModel('CryptoWallets');
        
        $cryptoWallet =null;
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => [],
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id]
            ]);
        }

        $this->set('cryptoWallet', $cryptoWallet);

        $this->set('cryptoTransaction', $cryptoTransaction);
        $this->set('customer_user_id', $customer_user_id);
    }

    /**
     * Send method
     *
     * @return \Cake\Http\Response|null Redirects on successful sent, renders view otherwise.
     */
    public function send($crypto_currency_id, $wallet_id=null)
    {
        $this->loadModel('CryptoTransactions');
        $this->loadModel('CryptoWallets');

        $customer_user_id = $this->Auth->user('id');

        /*
        if(empty($wallet_id)){
            $value_card_auth = $this->request->getSession()->read('ValueCardAuth');
            if($value_card_auth){
                $wallet_id = $value_card_auth['wallet_id'];
            }
        }
        * */

        $cryptoTransaction = $this->CryptoTransactions->newEntity();
        if ($this->request->is('post')) {
            $request_data = $this->request->getData(); //TODO: validate first the request data

            /*
            //$cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $request_data);
            $cryptoTransaction = $this->CryptoTransactions->newEntity($request_data);
            if ($this->CryptoTransactions->save($cryptoTransaction)) {
                $this->Flash->success(__('The crypto transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            * */

            $result_payment = null;

            if(isset($request_data['crypto_currency_id'])){

                $crypto_currency = $this->CryptoWallets->CryptoCurrencies->findById($request_data['crypto_currency_id'])->first();

                if($crypto_currency){

                    $crypto_currency_name = $crypto_currency->currency_unit_label;
                    if($crypto_currency_name == 'Varatto') $crypto_currency_name = 'Web3Service';

                    $crypto_currency_name_component = $crypto_currency_name . '.Account';

                    $this->loadComponent($crypto_currency_name_component);

                    $result_payment  = $this->Account->sendPayment($request_data['source_wallet_address'], $request_data['target_wallet_address'], 
                        $request_data['amount'], '1234');

                    if($result_payment['status']==Web3Controller::WEB3_STATUS_SUCCESS){
                        $request_data['transaction_hash'] = $result_payment['transaction_hash'];
                        $request_data['transaction_type'] = 'outbound';
                        $request_data['currency_amount'] = 0.00;
                        $request_data['fees'] = 0.00;
                        $request_data['crypto_currency_name'] = $crypto_currency->currency_unit_label ;
                        $request_data['customer_user_id'] = $customer_user_id ;
                        $cryptoTransaction = $this->CryptoTransactions->newEntity($request_data);
                        $this->CryptoTransactions->save($cryptoTransaction);
                    }
                }
            }

            if(empty($result_payment)){
                $this->Flash->error(__('The payment could not be sent. Please, try again.'));
            }else if($result_payment['status']==Web3Controller::WEB3_STATUS_SUCCESS) {
                $this->Flash->success(__('Payment has been succesfully sent.'));
                //return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__($result_payment['message']));
            }


        }

        $cryptoWallet = null;
        $cryptoWallets = null;
        $this->loadModel('CryptoWallets');

        if(!empty($wallet_id)){

            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id,
                    'CryptoWallets.id' => $wallet_id,
                    'CryptoWallets.crypto_currency_id' => $crypto_currency_id]
            ]);

            $cryptoWallets = $this->CryptoWallets->find('list', [
                'keyField' => 'wallet_address', 'valueField' => 'wallet_address',
                'limit' => 200, 'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id,
                    'CryptoWallets.id' => $wallet_id,
                    'CryptoWallets.crypto_currency_id' => $crypto_currency_id]
            ]);

            $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list',
                ['keyField' => 'id', 'valueField' => 'currency_unit_label',
                    'limit' => 200, 'conditions' => ['CryptoCurrencies.id' => $cryptoWallet->crypto_currency_id ]]
            );
        }else{
            $cryptoWallets = $this->CryptoWallets->find('list', [
                'keyField' => 'wallet_address', 'valueField' => 'wallet_address',
                'limit' => 200, 'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id,
                    'CryptoWallets.crypto_currency_id' => $crypto_currency_id]
            ]);
            $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list',
                ['keyField' => 'id', 'valueField' => 'currency_unit_label',
                    'limit' => 200, 'conditions' => ['CryptoCurrencies.id' => $crypto_currency_id ]]
            );
        }


        $cryptoCurrency = $this->CryptoTransactions->CryptoCurrencies->get($crypto_currency_id);

        $this->set(compact('cryptoTransaction', 'cryptoCurrencies', 'cryptoCurrency', 'customer_user_id', 'cryptoWallet', 'cryptoWallets', 'wallet_id'));
    }
    
    /**
     * Receive method
     *
     * @return \Cake\Http\Response|null Redirects on successful received, renders view otherwise.
     */
    public function receive($crypto_currency_id, $wallet_id=null)
    {
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = $this->Auth->user('id');
        
        /*
        if(empty($wallet_id)){
            $value_card_auth = $this->request->getSession()->read('ValueCardAuth');
            if($value_card_auth){
                $wallet_id = $value_card_auth['wallet_id'];
            }
        }
        * */
        
        $cryptoTransaction = $this->CryptoTransactions->newEntity();
        if ($this->request->is('post')) {
            $request_data = $this->request->getData(); //TODO: validate first the request data

            $result_wallet = null;

            if(isset($request_data['crypto_currency_id'])){
                //TODO: redirect to payment gateway

                //$cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $request_data);
                $cryptoTransaction = $this->CryptoTransactions->newEntity($request_data);
                if ($this->CryptoTransactions->save($cryptoTransaction)) {
                    $this->Flash->success(__('The crypto transaction has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }


            $this->Flash->error(__('The crypto transaction could not be saved. Please, try again.'));
        }

        $this->loadModel('CryptoWallets');
        
        $cryptoWallet =null;
        $cryptoWallets = null;
        $currencies = $this->CryptoTransactions->Currencies->find('list', ['conditions' => ['Currencies.is_active' => true], 'limit' => 200]);

        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id,
                    'CryptoWallets.id' => $wallet_id,
                    'CryptoWallets.crypto_currency_id' => $crypto_currency_id]
            ]);

            $cryptoWallets = $this->CryptoWallets->find('list', [
                'keyField' => 'wallet_address', 'valueField' => 'wallet_address',
                'limit' => 200, 'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id,
                    'CryptoWallets.id' => $wallet_id,
                    'CryptoWallets.crypto_currency_id' => $crypto_currency_id]
            ]);

            $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list',
                ['keyField' => 'id', 'valueField' => 'currency_unit_label',
                    'limit' => 200, 'conditions' => ['CryptoCurrencies.id' => $crypto_currency_id ]]
            );
        }else{

            $cryptoWallets = $this->CryptoWallets->find('list', [
                'keyField' => 'wallet_address', 'valueField' => 'wallet_address',
                'limit' => 200, 'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id,
                    'CryptoWallets.crypto_currency_id' => $crypto_currency_id]
            ]);
            $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list',
                ['keyField' => 'id', 'valueField' => 'currency_unit_label',
                    'limit' => 200, 'conditions' => ['CryptoCurrencies.id' => $crypto_currency_id ]]
            );
        }

        $cryptoCurrency = $this->CryptoTransactions->CryptoCurrencies->get($crypto_currency_id);

        $this->set(compact('cryptoTransaction', 'currencies', 'cryptoCurrencies', 'cryptoCurrency', 'customer_user_id', 'cryptoWallet', 'cryptoWallets', 'wallet_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editSend($transaction_id=null, $wallet_id = null)
    {
        
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->get($transaction_id, [
            'contain' => [],
            'conditions' => ['CryptoTransactions.customer_user_id' => $customer_user_id]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $this->request->getData());
            if ($this->CryptoTransactions->save($cryptoTransaction)) {
                $this->Flash->success(__('The crypto transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crypto transaction could not be saved. Please, try again.'));
        }
        $currencies = $this->CryptoTransactions->Currencies->find('list', ['conditions' => ['Currencies.is_active' => true], 'limit' => 200]);
        $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list', ['keyField' => 'id', 'valueField' => 'currency_unit_label', 'limit' => 200]);
        
        $this->loadModel('CryptoWallets');
        
        $cryptoWallet =null;
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => [],
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id]
            ]);
        }

        $this->set(compact('cryptoTransaction', 'currencies', 'cryptoCurrencies', 'customer_user_id', 'cryptoWallet'));
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Payment Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editReceive($transaction_id=null, $wallet_id = null)
    {
        
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->get($id, [
            'contain' => [],
            'conditions' => ['CryptoTransactions.customer_user_id' => $customer_user_id]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $this->request->getData());
            if ($this->CryptoTransactions->save($cryptoTransaction)) {
                $this->Flash->success(__('The crypto transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crypto transaction could not be saved. Please, try again.'));
        }
        $currencies = $this->CryptoTransactions->Currencies->find('list', ['conditions' => ['Currencies.is_active' => true], 'limit' => 200]);
        $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list', ['keyField' => 'id', 'valueField' => 'currency_unit_label', 'limit' => 200]);
        
        
        $this->loadModel('CryptoWallets');
        
        $cryptoWallet =null;
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => [],
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id]
            ]);
        }

       
        $this->set(compact('cryptoTransaction', 'currencies', 'cryptoCurrencies', 'customer_user_id', 'cryptoWallet'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Crypto Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($transaction_id=null, $wallet_id = null)
    {
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = $this->Auth->user('id');
        
        $this->request->allowMethod(['post', 'delete']);
        $cryptoTransaction = $this->CryptoTransactions->get($transaction_id, [
                'conditions' => ['CryptoTransactions.customer_user_id' => $customer_user_id]
            ]
            
        );
        if ($this->CryptoTransactions->delete($cryptoTransaction)) {
            $this->Flash->success(__('The crypto transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The crypto transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
