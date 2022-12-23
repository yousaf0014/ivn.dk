<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use Reepay\Api\SubscriptionApi;
use Reepay\Api\CustomerApi;
use Reepay\Api\InvoiceApi;
use Reepay\Model\ChangeSubscription;
class Reepay{	
	
	public function changeUserPlan($handle,$body){		
		$api_instance = new SubscriptionApi;
		try {
			$result = $api_instance->changeSubscription($handle,$body);
		}catch(\Exception $e){
		    return false;
		}
		return true;
	}

	public function createSubscription($reepaytoken){
		$user = Auth::user();
		$customerApi = new CustomerApi;
		$body['email'] = $user->email;
		$body['first_name'] = $user->first_name;
		$body['last_name'] = $user->last_name;
		$body['city'] = $user->city;
		$body['address'] = $user->address;
		$body['postal_code'] = $user->zipcode;
		$body['phone'] = $user->mobile;
		$body["generate_handle"] = true;
		$body['handle'] = 'Cust_'.$user->id;
		try {
			$customer = $customerApi->createCustomerJson($body);
			if(!empty($customer['handle'])){
				$user->reepay_customer_id = $customer['handle'];
				$body = array();
				$body['customer'] = $customer['handle'];
				$planList = array('level2'=>getPlanID("silver"),'level3'=>getPlanID("gold"));
				$amount = array('level2'=>floatval(getPlanPrice('silver')) * 100,'level3'=>floatval(getPlanPrice('gold')) * 100);
				$body['plan'] = isset($planList[$user->user_subscription]) ? $planList[$user->user_subscription]:getPlanID("silver");
				$body['amount'] = isset($amount[$user->user_subscription]) ? $amount[$user->user_subscription]:'0';
				$body['quantity'] = 1;
				$body['signup_method'] = 'source';
				$body['generate_handle'] = true;
				$body['source'] = $reepaytoken;
				$api_instance = new SubscriptionApi;
				$result = $api_instance->createSubscriptionJson($body);
				if(!empty($result['handle'])){
					$user->handle = $result['handle'];
					$user->save();
					return true;
				}
				return false;				
			}	
		}catch(\Exception $e){
		    return false;
		}
		return false;
	}

	public function cancelUserPlan($handle){
		$body['notice_periods'] = 0;
		$api_instance = new SubscriptionApi;
		try {
		    $result = $api_instance->cancelSubscription($handle,$body);
		    return true;
		}catch(\Exception $e){
			return false;	
		} 
		return false;
	}

	public function uncancel($handle){
		$api_instance = new SubscriptionApi;
		try {
		    $result = $api_instance->uncancel($handle);
		    return true;
		}catch(\Exception $e){
			return false;	
		} 
		return false;
	}
	
	public function checkSubscription($handle){
		$api_instance = new SubscriptionApi;
		$data;
		try{	
			$data = $api_instance->getSubscription($handle);			
		}catch(\Exception $e){
			return false;	
		} 
		return $data;	
	}

	public function getInvoices($handle){
		$api_instance = new InvoiceApi;
		$page = 1; // int | Page number to get
		$size = 50; // int | Page size to use
		$search = 'customer.handle:'.$handle; //"customer.handle=".$handle; // string | Optional search expression
		$sort = '';
		$result = array();
		try {
		    $result = $api_instance->getInvoices($page, $size, $search, $sort);
		}catch(\Exception $e){
		    return false;
		}
		return $result;
	}

}