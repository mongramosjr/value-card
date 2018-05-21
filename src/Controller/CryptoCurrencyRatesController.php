<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CryptoCurrencyRates Controller
 *
 * @property \App\Model\Table\CryptoCurrencyRatesTable $CryptoCurrencyRates
 *
 * @method \App\Model\Entity\CryptoCurrencyRate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CryptoCurrencyRatesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
        $customer_user_id = null;
        
        if($customer_user_id==null) $customer_user_id = $this->Auth->user('id');
        
        $this->paginate = [
            'contain' => ['CryptoCurrencies']
        ];
        $cryptoCurrencyRates = $this->paginate($this->CryptoCurrencyRates);

        $this->set(compact('cryptoCurrencyRates', 'customer_user_id'));
    }
}
