<?php
namespace App\Controller;

use App\Controller\AppController;

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
    public function index($customer_user_id = null)
    {
        $this->loadModel('CryptoTransactions');
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $this->paginate = [
            'contain' => ['CustomerUsers', 'Currencies', 'CryptoCurrencies']
        ];
        $cryptoTransactions = $this->paginate($this->CryptoTransactions);

        $this->set(compact('cryptoTransactions', 'customer_user_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment Transaction id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($transaction_id=null, $wallet_id = null)
    {
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->get($transaction_id, [
            'contain' => ['CustomerUsers', 'Currencies', 'CryptoCurrencies']
        ]);

        $this->set('cryptoTransaction', $cryptoTransaction);
        $this->set('customer_user_id', $customer_user_id);
    }

    /**
     * Send method
     *
     * @return \Cake\Http\Response|null Redirects on successful sent, renders view otherwise.
     */
    public function send($wallet_id=null)
    {
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->newEntity();
        if ($this->request->is('post')) {
            $cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $this->request->getData());
            if ($this->CryptoTransactions->save($cryptoTransaction)) {
                $this->Flash->success(__('The crypto transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crypto transaction could not be saved. Please, try again.'));
        }
        $customerUsers = $this->CryptoTransactions->CustomerUsers->find('list', ['limit' => 200]);
        $currencies = $this->CryptoTransactions->Currencies->find('list', ['limit' => 200]);
        $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list', ['limit' => 200]);
        $this->set(compact('cryptoTransaction', 'customerUsers', 'currencies', 'cryptoCurrencies', 'customer_user_id'));
    }
    
    /**
     * Receive method
     *
     * @return \Cake\Http\Response|null Redirects on successful received, renders view otherwise.
     */
    public function receive($wallet_id=null)
    {
        $this->loadModel('CryptoTransactions');
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->newEntity();
        if ($this->request->is('post')) {
            $cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $this->request->getData());
            if ($this->CryptoTransactions->save($cryptoTransaction)) {
                $this->Flash->success(__('The crypto transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crypto transaction could not be saved. Please, try again.'));
        }
        $customerUsers = $this->CryptoTransactions->CustomerUsers->find('list', ['limit' => 200]);
        $currencies = $this->CryptoTransactions->Currencies->find('list', ['limit' => 200]);
        $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list', ['limit' => 200]);
        $this->set(compact('cryptoTransaction', 'customerUsers', 'currencies', 'cryptoCurrencies', 'customer_user_id'));
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
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->get($transaction_id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $this->request->getData());
            if ($this->CryptoTransactions->save($cryptoTransaction)) {
                $this->Flash->success(__('The crypto transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crypto transaction could not be saved. Please, try again.'));
        }
        $customerUsers = $this->CryptoTransactions->CustomerUsers->find('list', ['limit' => 200]);
        $currencies = $this->CryptoTransactions->Currencies->find('list', ['limit' => 200]);
        $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list', ['limit' => 200]);
        $this->set(compact('cryptoTransaction', 'customerUsers', 'currencies', 'cryptoCurrencies', 'customer_user_id'));
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
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $cryptoTransaction = $this->CryptoTransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cryptoTransaction = $this->CryptoTransactions->patchEntity($cryptoTransaction, $this->request->getData());
            if ($this->CryptoTransactions->save($cryptoTransaction)) {
                $this->Flash->success(__('The crypto transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The crypto transaction could not be saved. Please, try again.'));
        }
        $customerUsers = $this->CryptoTransactions->CustomerUsers->find('list', ['limit' => 200]);
        $currencies = $this->CryptoTransactions->Currencies->find('list', ['limit' => 200]);
        $cryptoCurrencies = $this->CryptoTransactions->CryptoCurrencies->find('list', ['limit' => 200]);
        $this->set(compact('cryptoTransaction', 'customerUsers', 'currencies', 'cryptoCurrencies', 'customer_user_id'));
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
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $this->request->allowMethod(['post', 'delete']);
        $cryptoTransaction = $this->CryptoTransactions->get($transaction_id);
        if ($this->CryptoTransactions->delete($cryptoTransaction)) {
            $this->Flash->success(__('The crypto transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The crypto transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
