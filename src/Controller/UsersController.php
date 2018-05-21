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


    public function login()
    {
        $this->loadModel('CustomerUsers');
        
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
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
    public function view($id = null)
    {
        $this->loadModel('CustomerUsers');
        
        $user = $this->CustomerUsers->get($id, [
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
        $user->lognum = 0;$user->is_active = false;
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $request_data['lognum'] = 0; $request_data['is_active'] = 0;
            $user = $this->CustomerUsers->patchEntity($user, $request_data);
            if ($this->CustomerUsers->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function changePassword($id = null)
    {
        $this->loadModel('CustomerUsers');
        
        $user = $this->CustomerUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //TODO: change password only
            $user = $this->CustomerUsers->patchEntity($user, $this->request->getData());
            if ($this->CustomerUsers->save($user)) {
                $this->Flash->success(__('Your password has been changed.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password could not be changed. Please, try again.'));
        }
        $this->set(compact('user'));
    }
}
