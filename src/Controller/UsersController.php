<?php
namespace App\Controller;

use App\Controller\AppController;

use Web3Service\Controller\AppController as Web3Controller;

use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;

/**
 * Users Controller
 *
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'signup']);
    }
    
    public function isAuthorized($user)
    {
        $this->loadModel('CustomerUsers');
        
        $action = $this->request->getParam('action');
        // The ''view', 'changePassword' actions are always allowed to logged in users.
        if (in_array($action, ['view', 'changePassword'])) {
            return true;
        }

        // All other actions require a slug.
        $customer_user_id = $this->request->getParam('pass.0');
        if (!$customer_user_id) {
            return false;
        }

        // Check that the wallet belongs to the current user.
        $customer_user = $this->CustomerUsers->findById($customer_user_id)->first();

        return $customer_user->id === $user['id'];
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        $session = $this->getRequest()->getSession();
        $session->delete('Auth');
        $session->delete('auth');
        $session->delete('ValueCardAuth');
        return $this->redirect($this->Auth->logout());
    }

    public function login()
    {
        $this->loadModel('CustomerUsers');
        
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $redirect_url = $this->Auth->redirectUrl();
                
                $session = $this->getRequest()->getSession();
                $session->write('ValueCardAuth.customer_user_id' , $user['id']);
                $session->write('ValueCardAuth.email' , $user['email']);
                $session->write('ValueCardAuth.full_name' , $user['full_name']);
                
                $this->loadModel('CryptoWallets');
                
                $cryptoWallet = $this->CryptoWallets->find()
                    ->where(['customer_user_id' => $user['id']])
                    ->where(function (QueryExpression $exp, Query $q) {
                        return $exp->isNotNull('wallet_address');
                    })
                ->first();
                
                if($cryptoWallet){
                
                    $session->write('ValueCardAuth.wallet_id' , $cryptoWallet->id);
                    $session->write('ValueCardAuth.crypto_currency_id' , $cryptoWallet->crypto_currency_id);
                }
                
                if(empty($redirect_url) or strlen($redirect_url)==1){
                    return $this->redirect(['controller' => 'Users', 'action' => 'view', $user['id']]);
                }else{
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $this->loadModel('CustomerUsers');
        
        $wallet_id = null; $cryptoWallet = null;
        
        $customer_user_id = $this->Auth->user('id');
        
        $value_card_auth = $this->request->getSession()->read('ValueCardAuth');

        if($value_card_auth){
            $wallet_id = $value_card_auth['wallet_id'];
        }
        
        
        if($customer_user_id != $this->Auth->user('id')) $customer_user_id = $this->Auth->user('id');
        
        $user = $this->CustomerUsers->get($customer_user_id, [
            'contain' => []
        ]);
        
        
        
        $this->loadModel('CryptoWallets');
        
        if(!empty($wallet_id)){
            $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                'contain' => [],
                'conditions' => ['CryptoWallets.customer_user_id' => $customer_user_id]
            ]);
        }

        $this->set('cryptoWallet', $cryptoWallet);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function signup()
    {
        $this->loadModel('CustomerUsers');
        
        $this->loadComponent('Web3Service.Account');
        $this->loadComponent('AccountUser');
        
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            
            if($request_data['password_crypt']!=$request_data['password2']){
                $this->Flash->error(__('Password not matched'));
                return;
            }
            
            $result_user = $this->AccountUser->create($request_data['full_name'], $request_data['email'], $request_data['password_crypt']);
            
            
            if(empty($result_user)){
                $this->Flash->error(__('The account could not be saved. Please, try again.'));
            }
            
            $result  = $this->Account->create($request_data['password_crypt']);
            
            if($result['status']==Web3Controller::WEB3_STATUS_SUCCESS){
                $wallet_address = $result['wallet_address'];
                $crypto_currency_id = $result['crypto_currency_id'];
                $customer_user_id = $result_user->id;
                $this->AccountUser->newWallet($customer_user_id, $wallet_address, $crypto_currency_id);
            }
            
            if ($result['status']==Web3Controller::WEB3_STATUS_SUCCESS) {
                $this->Flash->success(__('An Account ID ' . $customer_user_id .  ' has been saved.'));
                
                
                $session = $this->getRequest()->getSession();
                $session->write('ValueCardRegistration.customer_user_id' , $result_user->id);
                $session->write('ValueCardRegistration.email' , $request_data['email']);
                $session->write('ValueCardRegistration.full_name' , $request_data['full_name']);

                return $this->redirect(['action' => 'signupResult']);
            }
            $this->Flash->error(__('The account could not be saved. Please, try again.'));
        }
    }
    
    public function signupResult()
    {
        $value_card_reg = $this->request->getSession()->read('ValueCardRegistration');
        $this->set('email', $value_card_reg['email']);
        $this->set('account_id', $value_card_reg['customer_user_id']);
        
        $this->render('signup_result', 'account_setup');
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function changePassword()
    {
        $this->loadModel('CustomerUsers');
        
        $customer_user_id = $this->Auth->user('id');
        
        $user = $this->CustomerUsers->get($customer_user_id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //TODO: change password only
            $user = $this->CustomerUsers->patchEntity($user, $this->request->getData());
            if ($this->CustomerUsers->save($user)) {
                $this->Flash->success(__('Your password has been changed.'));

                return $this->redirect(['action' => 'view']);
            }
            $this->Flash->error(__('The password could not be changed. Please, try again.'));
        }
        $this->set(compact('user'));
    }
}
