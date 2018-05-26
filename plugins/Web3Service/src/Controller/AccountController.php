<?php
namespace Web3Service\Controller;

use Web3Service\Controller\AppController as Web3Controller;


/**
 * Account Controller
 *
 *
 * @method \Web3Service\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        
        $this->Auth->allow(['create', 'balance', 'lock', 'unlock', 'sendPayment', 'index']);
        
        $this->loadComponent('Web3Service.Account');
        $this->loadComponent('AccountUser');
    }
    
    public function create()
    {
        $default_data = array(
            'password'=>null,
            'full_name'=>null,
            'authorization_id'=>null,
            'email'=>null
        );
        
        /////////////////////
        //TEST DATA
        //$rand = rand(1000,3000000);
        //$default_data['full_name']='Mong Ramos ' . $rand;
        //$default_data['email'] = 'mongramosjr-' . $rand . '@gmail.com';
        //$default_data['password']='truespace4';
        //$default_data['authorization_id']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        if(empty($requested_with )){
            $requested_with = $this->RequestHandler->prefers();
        }
        
        $requested_data = null;
        $data_sanitized = null;
        
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
                $requested_data = $this->request->getData();
            break;
        }
        
        
        if(empty($requested_data)){
            $data_sanitized = $default_data;
        }else{
            $data_sanitized = array_merge($default_data, $requested_data);
        }
        
        $data_sanitized['password'] = trim($data_sanitized['password']);
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($data_sanitized['password']) || empty($data_sanitized['full_name']) || empty($data_sanitized['email']))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required argument";
        }
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }
        
        
        $result_user = $this->AccountUser->create($data_sanitized['full_name'], $data_sanitized['email'], $data_sanitized['password']);
        
        if(empty($result_user)){
            $this->set([
                'message'           => 'The account could not be created. Please, try again',
                'status'            => Web3Controller::WEB3_STATUS_FAIL,
                '_serialize'     => ['message', 'status']
            ]);
            return;
        }
        
        $result  = $this->Account->create($data_sanitized['password']);
        
        if($result['status']==Web3Controller::WEB3_STATUS_SUCCESS){
            $wallet_address = $result['wallet_address'];
            $crypto_currency_id = $result['crypto_currency_id'];
            $customer_user_id = $result_user->id;
            $this->AccountUser->newWallet($customer_user_id, $wallet_address, $crypto_currency_id);
        }
        
        
        if($result['status']==Web3Controller::WEB3_STATUS_SUCCESS){
            
            $this->set([
                'message'           => $result['message'],
                'status'            => $result['status'],
                'wallet_address'    => $result['wallet_address'],
                'crypto_currency_name'    => $result['crypto_currency_name'],
                'account_id'    => $result_user->id,
                '_serialize'        => ['message', 'status', 'wallet_address', 'crypto_currency_name', 'account_id']
            ]);
            return;
        }else{
            $this->set([
                'message'           => $result['message'],
                'status'            => $result['status'],
                '_serialize'     => ['message', 'status']
            ]);
            return;
        }
        
        
    }
    
    public function balance()
    {
        $default_data = array(
            'wallet_address'=>null,
            'authorization_id'=>null
        );
        
        /////////////////////
        //TEST DATA
        //$default_data['wallet_address']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        //$default_data['authorization_id']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        if(empty($requested_with )){
            $requested_with = $this->RequestHandler->prefers();
        }
        
        $requested_data = null;
        $data_sanitized = null;
        
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
                $requested_data = $this->request->getData();
            break;
        }
        
        if(empty($requested_data)){
            $data_sanitized = $default_data;
        }else{
            $data_sanitized = array_merge($default_data, $requested_data);
        }
        
        $data_sanitized['wallet_address'] = trim($data_sanitized['wallet_address']);
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($data_sanitized['wallet_address']))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required argument";
        }
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }
        
        
        $result  = $this->Account->balance($data_sanitized['wallet_address']);
        
        if($result['status']==Web3Controller::WEB3_STATUS_SUCCESS){
            $this->set([
                'message'           => $result['message'],
                'status'            => $result['status'],
                'wallet_address'    => $result['wallet_address'],
                'balance'           => $result['balance'],
                'unit'              =>  $result['unit'],
                '_serialize'        => ['message', 'status', 'balance', 'unit', 'wallet_address']
            ]);
            return;
        }else{
            $this->set([
                'message'       => $result['message'],
                'status'        => $result['status'],
                '_serialize'    => ['message', 'status']
            ]);
            return;
        }
    }
    
    public function unlock()
    {
        $default_data = array(
            'wallet_address'=>null,
            'password'=>null,
            'authorization_id'=>null
        );
        
        /////////////////////
        //TEST DATA
        //$default_data['wallet_address']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        //$default_data['password']='truespace4';
        //$default_data['authorization_id']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        if(empty($requested_with )){
            $requested_with = $this->RequestHandler->prefers();
        }
        
        $requested_data = null;
        $data_sanitized = null;
        
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
                $requested_data = $this->request->getData();
            break;
        }
        
        if(empty($requested_data)){
            $data_sanitized = $default_data;
        }else{
            $data_sanitized = array_merge($default_data, $requested_data);
        }
        
        $data_sanitized['wallet_address'] = trim($data_sanitized['wallet_address']);
        $data_sanitized['password'] = trim($data_sanitized['password']);
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($data_sanitized['password']) || empty($data_sanitized['wallet_address']))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required argument";
        }
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }
        
        
        $result  = $this->Account->unlock($data_sanitized['wallet_address'], $data_sanitized['password']);
        
        if($result['status']==Web3Controller::WEB3_STATUS_SUCCESS){
            $this->set([
                'message'           => $result['message'],
                'status'            => $result['status'],
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }else{
            $this->set([
                'message'       => $result['message'],
                'status'        => $result['status'],
                '_serialize'    => ['message', 'status']
            ]);
            return;
        }
    }
    
    public function lock()
    {
        $default_data = array(
            'wallet_address'=>null,
            'password'=>null,
            'authorization_id'=>null
        );
        
        /////////////////////
        //TEST DATA
        //$default_data['wallet_address']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        //$default_data['password']='truespace4';
        //$default_data['authorization_id']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        if(empty($requested_with )){
            $requested_with = $this->RequestHandler->prefers();
        }
        
        $requested_data = null;
        $data_sanitized = null;
        
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
                $requested_data = $this->request->getData();
            break;
        }
        
        if(empty($requested_data)){
            $data_sanitized = $default_data;
        }else{
            $data_sanitized = array_merge($default_data, $requested_data);
        }
        
        $data_sanitized['wallet_address'] = trim($data_sanitized['wallet_address']);
        $data_sanitized['password'] = trim($data_sanitized['password']);
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($data_sanitized['password']) || empty($data_sanitized['wallet_address']))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required argument";
        }
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }
        
        $result  = $this->Account->lock($data_sanitized['wallet_address'], $data_sanitized['password']);
        
        if($result['status']==Web3Controller::WEB3_STATUS_SUCCESS){
            $this->set([
                'message'           => $result['message'],
                'status'            => $result['status'],
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }else{
            $this->set([
                'message'       => $result['message'],
                'status'        => $result['status'],
                '_serialize'    => ['message', 'status']
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
            'amount'=>'0.0',
            'authorization_id'=>null
        );
        
        /////////////////////
        //TEST DATA
        //$default_data['from']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        //$default_data['password']='truespace4';
        //$default_data['to']='0x4516262954323c3e73468421efcb1f833fe3c2d7';
        //$default_data['amount']= "0.1";
        //$default_data['authorization_id']='0x02e162547dc22378b5c4b73401ccfc4bb9f7d095';
        /////////////////
        
        $requested_with = $this->RequestHandler->requestedWith();
        if(empty($requested_with )){
            $requested_with = $this->RequestHandler->prefers();
        }
        
        $requested_data = null;
        $data_sanitized = null;
        
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
                $requested_data = $this->request->getData();
            break;
        }
        
        if(empty($requested_data)){
            $data_sanitized = $default_data;
        }else{
            $data_sanitized = array_merge($default_data, $requested_data);
        }
        
        $data_sanitized['from'] = trim($data_sanitized['from']);
        $data_sanitized['password'] = trim($data_sanitized['password']);
        $data_sanitized['to'] = trim($data_sanitized['to']);
        
        $status =  Web3Controller::WEB3_STATUS_ERROR;
        $message = 'Failed - General failure';
        
        if(empty($data_sanitized['from']) || empty($data_sanitized['to']) || empty($data_sanitized['password']) )
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Missing required argument";
        }
        
        if(empty($data_sanitized['amount']))
        {
            $status = Web3Controller::WEB3_STATUS_FAIL;
            $message = "Enter a valid amount";
            
        }
        
        
        if($status==Web3Controller::WEB3_STATUS_FAIL){
            $this->set([
                'message'        => $message,
                'status'        => $status,
                '_serialize'        => ['message', 'status']
            ]);
            return;
        }
        
        $result  = $this->Account->sendPayment($data_sanitized['from'], $data_sanitized['to'], $data_sanitized['amount'], $data_sanitized['password']);
        
        if($result['status']==Web3Controller::WEB3_STATUS_SUCCESS){
            $this->set([
                'message'           => $result['message'],
                'status'            => $result['status'],
                'extra_info'        => $result['extra_info'],
                'amount'            => $result['amount'],
                'unit'              => $result['unit'],
                'balance'           => $result['balance'],
                'current_balance'   => $result['current_balance'],
                'transaction_hash'  => $result['transaction_hash'],
                '_serialize'        => ['message', 'status', 'amount', 'balance', 'current_balance', 'transaction_hash', 'extra_info', 'unit']
            ]);
            return;
        }else{
            $this->set([
                'message'       => $result['message'],
                'status'        => $result['status'],
                'extra_info'          => $result['extra_info'],
                '_serialize'    => ['message', 'status', 'extra_info']
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
