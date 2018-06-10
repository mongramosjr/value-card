<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * CryptoCoinSideBar cell
 */
class CryptoCoinSideBarCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $customer_user_id = null;
        $value_card_auth = $this->request->getSession()->read('ValueCardAuth');
        
        $this->loadModel('CryptoWallets');
        
        
        $wallets = null;
        
        if($value_card_auth){
            $customer_user_id = $value_card_auth['customer_user_id'];
        
            $query = $this->CryptoWallets->find()->contain([
                    'CryptoCurrencies'
                ]);
            $query->where(['customer_user_id' => $customer_user_id]);
            
            $wallets = $query->all();
        }
        
        $this->set('wallets', $wallets);
    }
}
