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
        $this->Auth->allow(['index', 'create', 'view']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('CryptoWallets');
        
        $wallets = $this->paginate($this->CryptoWallets);

        $this->set(compact('wallets'));
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
        
        $wallet = $this->CryptoWallets->get($id, [
            'contain' => []
        ]);

        $this->set('wallet', $wallet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function create()
    {
        $this->loadModel('CryptoWallets');
        
        $wallet = $this->CryptoWallets->newEntity();
        if ($this->request->is('post')) {
            $wallet = $this->CryptoWallets->patchEntity($wallet, $this->request->getData());
            if ($this->CryptoWallets->save($wallet)) {
                $this->Flash->success(__('The wallet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
        }
        
        $customer_user_id = '';
        //$customerUser = $this->CryptoWallets->CustomerUsers->find('list', ['limit' => 200]);
        $cryptoCurrencies = $this->CryptoWallets->CryptoCurrencies->find('list', ['limit' => 200]);
        
        $this->set(compact('wallet', 'customer_user_id', 'cryptoCurrencies'));
    }

    
}
