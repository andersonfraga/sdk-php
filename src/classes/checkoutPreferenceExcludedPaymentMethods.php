<?php

class checkoutPreferenceExcludedPaymentMethods{

	public $id;
	
	function __construct(){
	}
	

	public function getExcludedPaymentMethodsId(){
		return $this->id;
	}
	
	public function setExcludedPaymentMethodsId($excluded_payment_methods_id){
	  	$this->id=$excluded_payment_methods_id;
	}
}
