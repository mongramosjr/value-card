<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * MenuNavigation cell
 */
class MenuNavigationCell extends Cell
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
        $navigation_right = array();
        
        
        
        
        if($value_card_auth){
            $customer_user_id = $value_card_auth['customer_user_id'];
            $wallet_id = $value_card_auth['wallet_id'];
            
            $this->loadModel('CryptoWallets');
        
             $cryptoWallet = null;
            
            if(!empty($wallet_id)){
                $cryptoWallet = $this->CryptoWallets->get($wallet_id, [
                    'contain' => []
                ]);
            }
            
            $navigation_right_profile = array();
            
            $navigation_right_profile[] = array('label' => 'Profile', 'url' => ['controller' => 'Users', 'action' => 'view'], 'options' => [], 'has_dropdown' => null);
            $navigation_right_profile[] = array('label' => 'Transactions', 'url' => ['controller' => 'PaymentTransactions', 'action' => 'index'], 'options' => [], 'has_dropdown' => null);
            $navigation_right_profile[] = array('label' => 'Logout', 'url' => ['controller' => 'Users', 'action' => 'logout'], 'options' => [], 'has_dropdown' => null);
            
            $navigation_right[] = array('label' => 'Dashboards', 'url' => ['controller' => 'CryptoCurrencyRates', 'action' => 'index'], 'options' => [], 'has_dropdown' => null);
            
            $navigation_right[] = array('label' => 'Wallets', 'url' => ['controller' => 'Wallets', 'action' => 'index'], 'options' => [], 'has_dropdown' => null);
            
            $navigation_right[] = array('label' => false, [], [], null);
            $navigation_right[] = array('label' => $value_card_auth['full_name'], 'url' => '#', 'options' => [], 'has_dropdown' => $navigation_right_profile);
        }else{
            $navigation_right[] = array('label' => 'Dashboards', 'url' => ['controller' => 'CryptoCurrencyRates', 'action' => 'index'], 'options' => [], 'has_dropdown' => null);
            $navigation_right[] = array('label' => 'Login', 'url' => ['controller' => 'Users', 'action' => 'login'], 'options' => [], 'has_dropdown' => null);
            $navigation_right[] = array('label' => 'Sign Up', 'url' => ['controller' => 'Users', 'action' => 'signup'], 'options' => [], 'has_dropdown' => null);
            
        }
        
        $this->set('navigation_right', $navigation_right);
    }
}
