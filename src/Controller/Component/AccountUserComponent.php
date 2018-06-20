<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Web3Service\Controller\AppController as Web3Controller;
use Cake\ORM\TableRegistry;

use Cake\Utility\Security;
use Cake\I18n\Time;


/**
 * AccountUser component
 */
class AccountUserComponent extends Component
{
    protected $_token_days_expires = 4;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    private function loadModel($model) {
        $this->$model = TableRegistry::get($model);
    }
    
    public function create($full_name, $email, $password_crypt)
    {
    
        $this->loadModel('CustomerUsers');
        
        $user = $this->CustomerUsers->newEntity();
        
        if(!empty($full_name) && !empty($email) && !empty($password_crypt)){
        
            $request_data = array();
            $request_data['lognum'] = 0; $request_data['is_active'] = 0;
            $request_data['full_name'] = $full_name;
            $request_data['email'] = $email;
            $request_data['password_crypt'] = $password_crypt;
            #$user = $this->CustomerUsers->patchEntity($user, $request_data);
            $user = $this->CustomerUsers->newEntity($request_data);
            if ($this->CustomerUsers->save($user)) {
                return $user;
            }
            return false;
        }
        return false;
    }
    
    public function signup_token($customer_user_id)
    {

        $this->loadModel('SignupConfirmations');

        $user = $this->SignupConfirmations->newEntity();

        if(!empty($customer_user_id)){

            $request_data = array();
            $hash = Security::hash($customer_user_id, 'sha256');
            $request_data['ccw_token'] = $hash;
            $request_data['ccw_token_created_at'] = new Time();
            $request_data['customer_user_id'] = $customer_user_id;
            $request_data['is_done'] = false;
            $request_data['is_confirmed'] = false;
            $signup_confirmation = $this->SignupConfirmations->newEntity($request_data);
            if ($this->SignupConfirmations->save($signup_confirmation)) {
                return $signup_confirmation;
            }
            return false;
        }
        return false;
    }

    public function check_signup_confirmation($signup_confirmation, $customer_user_id)
    {

        $this->loadModel('SignupConfirmations');

        if($signup_confirmation){
            $hash = Security::hash($customer_user_id, 'sha256');

            if($signup_confirmation->is_confirmed == true){
                return false;
            }

            $now_time = new Time();
            $ccw_token_created_at = new Time($signup_confirmation->ccw_token_created_at);
            $interval = $now_time->diff($ccw_token_created_at, false);

            if($interval->days >= $this->_token_days_expires){
                return false;
            }

            if($signup_confirmation->ccw_token == $hash){
                $signup_confirmation->is_confirmed = true;
                $this->SignupConfirmations->save($signup_confirmation);
                return true;
            }else{
                return false;
            }
        }

        return false;
    }

    public function newWallet($customer_user_id, $wallet_address, $crypto_currency_id, $wallet_label=null)
    {
        $this->loadModel('CryptoWallets');
        $this->loadModel('CryptoCurrencies');
        
        $wallet = $this->CryptoWallets->newEntity();
        
        if(!empty($customer_user_id) && !empty($wallet_address) && !empty($crypto_currency_id)){
            
            $crypto_currency = $this->CryptoCurrencies->findById($crypto_currency_id)->first();
            
            if($crypto_currency){
            
                $request_data = array();
                $request_data['customer_user_id'] = $customer_user_id; 
                $request_data['wallet_address'] = $wallet_address;
                $request_data['crypto_currency_id'] = $crypto_currency_id;
                $request_data['crypto_currency_name'] = $crypto_currency->name;
                $request_data['wallet_label'] = $wallet_label;
                
                #$wallet = $this->CryptoWallets->patchEntity($wallet, $request_data);
                $wallet = $this->CryptoWallets->newEntity($request_data);
                if ($this->CryptoWallets->save($wallet)) {
                    return $wallet;
                }
                return false;
            }else{
                return false;
            }
        }
        return false;
        
    }
}
