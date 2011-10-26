<?
require_once "checkoutPreferenceDataPayer.php";
require_once "checkoutPreferenceDataItems.php";
require_once "checkoutPreferenceDataPaymentMethods.php";
require_once "checkoutPreferenceDataBackUrls.php";

class CheckoutPreference  {

	public $id;
	public $external_reference;
	public $expires;
	public $payer;	
	public $items=array();
	public $back_urls;
	public $payment_methods;
	public $collector_id;
	public $subscription_plan_id;
	public $expiration_date_from;
	public $expiration_date_to;
	public $init_point;
	public $date_created;


	function __construct(){
	}

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;		
	}
		

	public function getExternalreference(){
		return $this->external_reference;
	}
	public function setExternalReference($externalReference){
		$this->external_reference = $externalReference;		
	}
	

	public function getExpires(){
		return $this->expires;
	}
	public function setExpires($expires){
		$this->expires = $expires;		
	}


	public function getCollectorId(){
		return $this->collector_id;
	}
	public function setCollectorId($collectorId){
		$this->collector_id = $collectorId;		
	}

	
	public function getSubscriptionPlanId(){
		return $this->subscription_plan_id;
	}
	public function setSubscriptionPlanId($subscriptionPlanId){
		$this->subscription_plan_id = $subscriptionPlanId;		
	}


	public function getExpirationDateFrom(){
		return $this->expiration_date_from;
	}
	public function setExpirationDateFrom($expirationDateFrom){
		$this->expiration_date_from= $expirationDateFrom;		
	}


	public function getExpirationDateTo(){
		return $this->expiration_date_to;
	}
	public function setExpirationDateTo($expirationDateTo){
		$this->expiration_date_to= $expirationDateTo;		
	}


	public function getInitPoint(){
		return $this->init_point;
	}
	public function setInitPoint($initPoint){
		$this->init_point= $initPoint;		
	}


	public function getDateCreated(){
		return $this->date_created;
	}
	public function setDateCreated($dateCreated){
		$this->date_created= $dateCreated;		
	}


	public function getBackUrls(){
		return $this->back_urls;
	}
	public function setBackUrls($backUrls){
		$this->back_urls = $backUrls;		
	}


	public function getPayer(){
		return $this->payer;
	}
	public function setPayer($payer){
		$this->payer = $payer;		
	}


	public function getPaymentMethods(){
		return $this->payment_methods;
	}
	public function setPaymentMethods($paymentMethods){
		$this->payment_methods= $paymentMethods;		
	}


	public function getItems(){
		return $this->items;
	}	
	public function setItems($items)
	  {
	    $this->items[]=$items;
	  }


	
}

