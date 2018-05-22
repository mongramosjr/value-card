<?php
namespace App\Controller;

use App\Controller\AppController;

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
        //if (in_array($action, ['view', 'changePassword'])) {
            //return true;
        //}

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
    public function view($customer_user_id = null)
    {
        $this->loadModel('CustomerUsers');
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        
        if($customer_user_id != $this->Auth->user('id')) $customer_user_id = $this->Auth->user('id');
        
        $user = $this->CustomerUsers->get($customer_user_id, [
            'contain' => []
        ]);

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
        
        $user = $this->CustomerUsers->newEntity();
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $request_data['lognum'] = 0; $request_data['is_active'] = 0;
            $user = $this->CustomerUsers->patchEntity($user, $request_data);
            if ($this->CustomerUsers->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'signupResult']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    
    public function signupResult()
    {
        $this->loadModel('CustomerUsers');
        
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function changePassword($customer_user_id = null)
    {
        $this->loadModel('CustomerUsers');
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
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
