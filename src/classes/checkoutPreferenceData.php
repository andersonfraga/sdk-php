<?
require_once "checkoutPreferenceDataPayer.php";
require_once "checkoutPreferenceDataItems.php";
require_once "checkoutPreferenceDataPaymentMethods.php";
require_once "checkoutPreferenceDataBackUrls.php";

class CheckoutPreferenceData  {

	public $external_reference;
	public $expires;
	public $payer;	
	public $items=array();
	public $back_urls;
	public $payment_methods;
	


	function __construct(){
	}

	public function getExternalReference(){
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
	public function setPaymentMethods($payment_methods){
		$this->payment_methods= $payment_methods;		
	}	
	

	public function setItems($item){
	    $this->items[]=$item;
	  }
	public function get_items(){
		return $this->items;
	}
	
}

