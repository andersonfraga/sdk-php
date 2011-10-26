<?php

class CheckoutPreferenceDataExcludedPaymentTypes{

	public $id;
	
	function __construct(){
	}
	

	public function getExcludedPaymentTypesId(){
		return $this->id;
	}
	
	public function setExcludedPaymentTypesId($excluded_payment_types_id){
	  	$this->id=$excluded_payment_types_id;	
	}
}
