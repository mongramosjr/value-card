<?php
namespace Web3Service\Controller;

use Web3Service\Controller\AppController as Web3Controller;
use Cake\Core\Configure;
use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

/**
 * Account Controller
 *
 *
 * @method \Web3Service\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountController extends AppController
{
    
    
    public function create()
    {
        $default_data = array(
            'password'=>null,
        );
        
        /////////////////////
        //TEST DATA
        $default_data['password']='truespace4';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        
        switch($requested_with)
        {
            case 'json':
                $requested_data = $this->request->input ( 'json_decode', true);
            break;
            case 'xml':
                libxml_use_internal_errors(true);
                $requested_data = $this->request->input();
                $requested_data = simplexml_load_string($requested_data, 'SimpleXMLElement', LIBXML_NOCDATA);
                if(!$requested_data) libxml_clear_errors();
                $requested_data = json_decode(json_encode($requested_data), TRUE);
                
            break;
            case 'form':
            default:
                $requested_data = $this->request->data();
            break;
        }
        
        $data_sanitized = array_merge($default_data, $requested_data);
        $data_sanitized['password'] = trim($data_sanitized['password']);
        
        $config = Configure::read('Web3Provider');
        
        //$web3 = new Web3($config['default']['provider']);
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $new_account = '';
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        // create account
        $personal->newAccount($data_sanitized['password'], function ($err, $account) use (&$new_account, &$status, &$message) {
            if ($err !== null) {
                $status = Web3Controller::WEB3STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            $new_account = $account;
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            $this->set([
                'message'        => 'Everything worked as expected',
                'status'        => $status,
                'valuecard_address'            => $new_account,
                '_serialize'        => ['message', 'status', 'valuecard_address']
            ]);
            return;
        }else{
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'     => ['message', 'status']
            ]);
            return;
        }
        
        
    }
    
    public function balance()
    {
        $default_data = array(
            'valuecard_address'=>null,
        );
        
        /////////////////////
        //TEST DATA
        $default_data['valuecard_address']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        
        switch($requested_with)
        {
            case 'json':
                $requested_data = $this->request->input ( 'json_decode', true);
            break;
            case 'xml':
                libxml_use_internal_errors(true);
                $requested_data = $this->request->input();
                $requested_data = simplexml_load_string($requested_data, 'SimpleXMLElement', LIBXML_NOCDATA);
                if(!$requested_data) libxml_clear_errors();
                $requested_data = json_decode(json_encode($requested_data), TRUE);
                
            break;
            case 'form':
            default:
                $requested_data = $this->request->data();
            break;
        }
        
        $data_sanitized = array_merge($default_data, $requested_data);
        $data_sanitized['valuecard_address'] = trim($data_sanitized['valuecard_address']);
        
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        $valuecard_balance = 0;
        
        // get balance
        $web3->eth->getBalance($data_sanitized['valuecard_address'], function ($err, $balance) use (&$valuecard_balance, &$status, &$message) {
                        
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            $valuecard_balance = $balance->toString();
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            $this->set([
                'message'        => 'Everything worked as expected',
                'status'        => $status,
                'balance'            => $valuecard_balance,
                '_serialize'        => ['message', 'status', 'balance']
            ]);
            return;
        }else{
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'     => ['message', 'status']
            ]);
            return;
        }
    }
    
    public function unlock()
    {
        $default_data = array(
            'valuecard_address'=>null,
            'password'=>null,
        );
        
        /////////////////////
        //TEST DATA
        $default_data['valuecard_address']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        $default_data['password']='truespace4';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        
        switch($requested_with)
        {
            case 'json':
                $requested_data = $this->request->input ( 'json_decode', true);
            break;
            case 'xml':
                libxml_use_internal_errors(true);
                $requested_data = $this->request->input();
                $requested_data = simplexml_load_string($requested_data, 'SimpleXMLElement', LIBXML_NOCDATA);
                if(!$requested_data) libxml_clear_errors();
                $requested_data = json_decode(json_encode($requested_data), TRUE);
                
            break;
            case 'form':
            default:
                $requested_data = $this->request->data();
            break;
        }
        
        $data_sanitized = array_merge($default_data, $requested_data);
        $data_sanitized['valuecard_address'] = trim($data_sanitized['valuecard_address']);
        $data_sanitized['password'] = trim($data_sanitized['password']);
        
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        $personal->unlockAccount($data_sanitized['valuecard_address'], $data_sanitized['password'], function ($err, $unlocked) use (&$status, &$message) {
            
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
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }else{
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'     => ['message', 'status']
            ]);
            return;
        }
    }
    
    public function lock()
    {
        $default_data = array(
            'valuecard_address'=>null,
            'password'=>null,
        );
        
        /////////////////////
        //TEST DATA
        $default_data['valuecard_address']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        $default_data['password']='truespace4';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        
        switch($requested_with)
        {
            case 'json':
                $requested_data = $this->request->input ( 'json_decode', true);
            break;
            case 'xml':
                libxml_use_internal_errors(true);
                $requested_data = $this->request->input();
                $requested_data = simplexml_load_string($requested_data, 'SimpleXMLElement', LIBXML_NOCDATA);
                if(!$requested_data) libxml_clear_errors();
                $requested_data = json_decode(json_encode($requested_data), TRUE);
                
            break;
            case 'form':
            default:
                $requested_data = $this->request->data();
            break;
        }
        
        $data_sanitized = array_merge($default_data, $requested_data);
        $data_sanitized['valuecard_address'] = trim($data_sanitized['valuecard_address']);
        $data_sanitized['password'] = trim($data_sanitized['password']);
        
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $personal = $web3->personal;
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        $personal->lockAccount($data_sanitized['valuecard_address'], $data_sanitized['password'], function ($err, $locked) use (&$status, &$message) {
            
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
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }else{
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'     => ['message', 'status']
            ]);
            return;
        }
    }
    
    
    public function sendPayment()
    {
        $default_data = array(
            'from'=>null,
            'password'=>null,
            'to'=>null,
            'amount'=>'0x0',
        );
        
        /////////////////////
        //TEST DATA
        $default_data['from']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        $default_data['password']='truespace4';
        $default_data['to']='0x4516262954323c3e73468421efcb1f833fe3c2d7';
        $default_data['amount']='0x11';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        
        switch($requested_with)
        {
            case 'json':
                $requested_data = $this->request->input ( 'json_decode', true);
            break;
            case 'xml':
                libxml_use_internal_errors(true);
                $requested_data = $this->request->input();
                $requested_data = simplexml_load_string($requested_data, 'SimpleXMLElement', LIBXML_NOCDATA);
                if(!$requested_data) libxml_clear_errors();
                $requested_data = json_decode(json_encode($requested_data), TRUE);
                
            break;
            case 'form':
            default:
                $requested_data = $this->request->data();
            break;
        }
        
        $data_sanitized = array_merge($default_data, $requested_data);
        $data_sanitized['from'] = trim($data_sanitized['from']);
        $data_sanitized['password'] = trim($data_sanitized['password']);
        $data_sanitized['to'] = trim($data_sanitized['to']);
        
        
        $config = Configure::read('Web3Provider');
        
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($config['default']['provider'], $config['default']['timeout'])));
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        $extra_info = '';
        
        $eth = $web3->eth;
        $personal = $web3->personal;
        
        
        $fromAccount = $data_sanitized['from'];
        $toAccount = $data_sanitized['to'];
        $amount = $data_sanitized['amount'];
        $valuecard_balance = 0;
        $transaction_hash = '';
        
        $personal->unlockAccount($data_sanitized['from'], $data_sanitized['password'], function ($err, $unlocked) use (&$status, &$message) {
            
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
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }
        
        //get balance
        $eth->getBalance($data_sanitized['from'], function ($err, $balance) use($fromAccount, $amount, &$status, &$message) {
            if ($err !== null) {
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = $err->getMessage();
                return;
            }
            
            $current_balance = floatval($balance->toString());
            $amount_to_pay = floatval($amount);
            if($current_balance < $amount_to_pay){
                $status = Web3Controller::WEB3_STATUS_FAIL;
                $message = 'Insufficient fund';
                return;
            }
        });
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }
        
        // send transaction
        $eth->sendTransaction([
            'from' => $fromAccount,
            'to' => $toAccount,
            'value' => $amount
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
                $valuecard_balance = floatval($balance->toString());
            });
            
            $message = 'Successful payment';
            $status = Web3Controller::WEB3_STATUS_SUCCESS;
        });
        
        if($status==Web3Controller::WEB3_STATUS_SUCCESS){
            $this->set([
                'message'        => $message,
                'extra_info'          => $extra_info,
                'status'        => $status,
                'amount'        => $amount,
                'balance'       => $valuecard_balance,
                'transaction_hash' => $transaction_hash,
                '_serialize'        => ['message', 'status', 'amount', 'balance', 'transaction_hash', 'extra_info']
            ]);
            return;
        }else{
            $this->set([
                'message'        => $message,
                'status'        => $status,
                'extra_info'          => $extra_info,
                '_serialize'     => ['message', 'status', 'extra_info']
            ]);
            return;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $message = 'Successful';
        $status = Web3Controller::WEB3_STATUS_SUCCESS;
            
        $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'     => ['message', 'status']
            ]);
        
    }

}
