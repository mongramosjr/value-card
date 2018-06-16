<?php
namespace Web3Service\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Web3Service\Controller\AppController as Web3Controller;
use Cake\ORM\TableRegistry;

use Cake\Core\Configure;
use Web3\Web3;
use Web3\Utils as Web3Utils;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

use phpseclib\Math\BigInteger as BigNumber;

/**
 * Account component
 */
class AccountComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    private function loadModel($model) {
        $this->$model = TableRegistry::get($model);
    }
    
    public function create($password)
    {
        $this->loadModel('CryptoCurrencies');
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        $password = trim($password);
        
        if(empty($password))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Password is required parameter";
            
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $new_account = '';
        
        
        // create account
        $personal->newAccount($password, function ($err, $account) use (&$new_account, &$status, &$message) {
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            $new_account = $account;
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        
        $crypto_currency_id = 1;
        $crypto_currency_name = 'DiVC';
        $crypto_currency_symbol = 'VC';
        
        $query = $this->CryptoCurrencies->find();
        
        $query->where(['name' => $crypto_currency_name]);
        $query->where(['symbol' => $crypto_currency_symbol]);
        
        $crypto_currency = $query->first();
        
        if($crypto_currency) {
            $crypto_currency_id = $crypto_currency->id;
            $crypto_currency_name = $crypto_currency->name;
        }
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            return array(
                'message'           => 'Successfully created a wallet address',
                'wallet_address'    => $new_account,
                'crypto_currency_name'    => $crypto_currency_name,
                'crypto_currency_id'    => $crypto_currency_id,
                'status'=>$status
            );
        }else{
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
        
        
    }
    
    public function balance($wallet_address)
    {
        /////////////////////
        //TEST DATA
        //$wallet_address='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        /////////////////
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($wallet_address))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required wallet address";
            
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $valuecard_balance = 0;
        
        // get balance
        $web3->eth->getBalance($wallet_address, function ($err, $balance) use (&$valuecard_balance, &$status, &$message) {
                        
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            $valuecard_balance = $balance->toString();
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            return array(
                'message'           => 'Everything worked as expected',
                'wallet_address'    => $wallet_address,
                'balance'           => $valuecard_balance,
                'unit'              => 'wei',
                'status'            => $status
            );
        }else{
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
        
    }
    
    public function unlock($wallet_address, $password)
    {
        /////////////////////
        //TEST DATA
        //$wallet_address='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        //$password='truespace4';
        /////////////////
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($password) || empty($wallet_address))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required parameters";
            
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $personal->unlockAccount($wallet_address, $password, function ($err, $unlocked) use (&$status, &$message) {
            
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            
            if ($unlocked) {
                $message = 'Account is unlocked!';
            } else {
                $message = 'Account isn\'t unlocked';
            }
            
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            return array(
                'message'           => $message,
                'status'            => $status
            );
        }else{
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
    }
    
    public function lock($wallet_address, $password)
    {
        /////////////////////
        //TEST DATA
        //$wallet_address='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        //$password='truespace4';
        /////////////////
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($password) || empty($wallet_address))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required parameters";
            
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $personal->lockAccount($wallet_address, $password, function ($err, $locked) use (&$status, &$message) {
            
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            
            if ($locked) {
                $message = 'Account is locked!';
            } else {
                $message = 'Account isn\'t locked';
            }
            
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            return array(
                'message'           => 'Successfully created a wallet address',
                'status'            => $status
            );
        }else{
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }
    }
    
    public function sendPayment($from, $to, $amount, $password)
    {
        /////////////////////
        //TEST DATA
        //$from='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        //$password='truespace4';
        //$to='0x4516262954323c3e73468421efcb1f833fe3c2d7';
        //$amount= "00";
        /////////////////
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($from) || empty($to) || empty($password) )
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required parameters";
            
            return array(
                'message'       => $message,
                'status'        => $status
            );
        }
        
        if(empty($amount))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Enter a valid amount";
            
            return array(
                'message'       => $message,
                'status'        => $status
            );
            
        }
        
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $extra_info = '';
        
        $eth = $web3->eth;
        $personal = $web3->personal;
        
        
        $fromAccount = $from;
        $toAccount = $to;
        $valuecard_balance = 0;
        $current_balance = 0;
        $transaction_hash = '';
        
        $ether = new BigNumber(Web3Utils::UNITS['ether']);
        $amount_in_wei = null;
        
        if (is_int($amount)) {
            
            $amount = floatval($amount);
            
        } elseif (is_numeric($amount)) {
            
            $amount = floatval($amount);
            
        } elseif (is_string($amount)) {
            
            $amount = mb_strtolower($amount);
            
            $amount = ltrim($amount, "0x");
            if (ctype_xdigit($amount)) {
                $amount = floatval(hexdec($amount));
            }else{
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = "Invalid amount";
            }
        }else{
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Invalid value of amount";
        }
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            return array(
                'message'       => $message,
                'status'        => $status
            );
        }
        
        
        //convert amount in decimal to wei unit
        if(is_float($amount)){
            
            
            //convert float to string without exp notation
            $string_amount = (string)$amount;
            if (preg_match('~\.(\d+)E([+-])?(\d+)~', $string_amount, $matches)) {
                $decimals = $matches[2] === '-' ? strlen($matches[1]) + $matches[3] : 0;
                $string_amount = number_format($amount, $decimals,'.','');
            }
            
            $whole = (int) $amount;
            $fraction = null;
            
            switch (true) {
                case extension_loaded('gmp'):
                    
                    //break;
                case extension_loaded('bcmath'):
                    $fraction = bcsub($string_amount, $whole, Web3Controller::ETHER_TO_WEI_SIZE);
                    $fraction = bcmul($fraction, Web3Utils::UNITS['ether'], 0);
                    break;
                default:
                    if (strpos($string_amount, '.') > 0) {
                        $comps = explode('.', $string_amount);
                        $fraction = 0;
                        if (count($comps) > 2) {
                            $message = 'Amount must be a valid number.';
                            $status = Web3Controller::WEB3_STATUS_FAIL;
                        }else if(count($comps) == 2){
                            $fraction = str_pad($comps[1], Web3Controller::ETHER_TO_WEI_SIZE, "0", STR_PAD_RIGHT);
                            var_dump( $fraction);
                            if(strlen($fraction)>Web3Controller::ETHER_TO_WEI_SIZE){
                                $fraction = substr($fraction, 0, Web3Controller::ETHER_TO_WEI_SIZE);   
                            }
                            if(intval($fraction) == 0){
                                $fraction = "0";
                            }
                        }else if(count($comps) == 1){
                            $fraction = "0";
                        }else{
                            $message = 'Amount is not a valid number';
                            $status = Web3Controller::WEB3_STATUS_FAIL;
                        }
                    }
                    break;
            }
            
            
            
            $fraction = new BigNumber((string)$fraction);
            $whole = new BigNumber((string) $whole);
            $amount_in_wei = $whole->multiply($ether);
            $amount_in_wei = $amount_in_wei->add($fraction);
            
            if(empty($amount_in_wei->toString())){
                $message = 'Amount is zero';
                $status = Web3Controller::WEB3_STATUS_FAIL;
            }
        }
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            return array(
                'message'       => $message,
                'status'        => $status
            );
        }
       
        $personal->unlockAccount($fromAccount, $password, function ($err, $unlocked) use (&$status, &$message) {
            
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            
            if ($unlocked) {
                $message = 'Account is unlocked!';
            } else {
                $message = 'Authentication needed: password or unlock';
                $status = Web3Controller::WEB3_STATUS_FAIL;
            }
        });
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            return array(
                'message'       => $message,
                'status'        => $status
            );
        }
        
        //get balance
        $eth->getBalance($fromAccount, function ($err, $balance) use($fromAccount, $amount_in_wei, &$current_balance, &$status, &$message) {
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            
            $current_balance = $balance->toString();
            
            //compare with amount_in_wei
            if($balance->compare($amount_in_wei) < 0){
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = 'Insufficient fund';
                return;
            }
        });
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            return array(
                'message'       => $message,
                'status'        => $status
            );
        }
        
        // send transaction
        $eth->sendTransaction([
            'from' => $fromAccount,
            'to' => $toAccount,
            'value' => Web3Utils::toHex($amount_in_wei,true)
        ], function ($err, $transaction) use ($eth, $fromAccount, $toAccount, &$transaction_hash, &$valuecard_balance, &$status, &$message, &$extra_info) {
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            
            $transaction_hash = $transaction;
            
            // get balance
            $eth->getBalance($fromAccount, function ($err, $balance) use(&$valuecard_balance) {
                if ($err !== null) {
                    $info = $err->getMessage();
                    return;
                }
                $valuecard_balance = $balance->toString();
            });
            
            $message = 'Successful payment';
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            
            return array(
                'message'           => $message,
                'status'            => $status,
                'extra_info'        => $extra_info,
                'amount'            => $amount_in_wei->toString(),
                'unit'              => 'wei',
                'balance'           => $valuecard_balance,
                'current_balance'   => $current_balance,
                'transaction_hash'  => $transaction_hash,
            );
        }else{
            
            return array(
                'message'       => $message,
                'status'        => $status,
                'extra_info'          => $extra_info,
            );
        }
    }

    public function getTransaction($transaction_hash)
    {
        /////////////////////
        //TEST DATA
        //$transaction_hash='0xaed88d34f7abd708844caf6e0bdca4fec4c98d6d834f12366fbdd44f9704461b';
        /////////////////

        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';

        if(empty($transaction_hash))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required transaction hash";

            return array(
                'message'        => $message,
                'status'=>$status
            );
        }

        $config = Configure::read('Web3Provider');

        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));

        $personal = $web3->personal;

        $valuecard_balance = 0;

        $result_array = array();

        // get balance
        $web3->eth->getTransactionByHash($transaction_hash, function ($err, $transaction)  use (&$result_array, &$status, &$message) {

            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }

            $result_array['gas'] =  $transaction->gas;
            $result_array['gasPrice'] =  $transaction->gasPrice;
            $result_array['blockHash'] =  $transaction->blockHash;
            $result_array['target_wallet_address'] =  $transaction->to;
            $result_array['source_wallet_address'] =  $transaction->from;
            $result_array['amount'] =  $transaction->value;
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });

        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            $result_array['message']    = 'Everything worked as expected';
            $result_array['unit']       = 'wei';
            $result_array['status']     = $status;
            return $result_array;

        }else{
            return array(
                'message'        => $message,
                'status'=>$status
            );
        }

    }
}
