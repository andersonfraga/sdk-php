
<?

class CheckoutPreferencePaymentMethods {

	public $excluded_payment_methods=array();
	public $excluded_payment_types=array();
	public $installments;
	
	function __construct(){
	}
	

	public function getExcludedPaymentMethods(){
		return $this->excluded_payment_methods;
	}
	
	public function setExcludedPaymentMethods($excluded_payment_methods){
	  	$this->excluded_payment_methods[]=$excluded_payment_methods;
	  
	
	}
	

	public function getExcludedPaymentTypes(){
		return $this->excluded_payment_types;
	}
	public function setExcludedPaymentTypes($excluded_payment_types){
		$this->excluded_payment_types[] = $excluded_payment_types;		
	}


	public function getInstallments(){
		return $this->installments;
	}
	public function setInstallments($installments){
		$this->installments = $installments;		
	}


}
