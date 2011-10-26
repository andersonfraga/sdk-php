<?
class CheckoutPreferenceBackUrls{
	
	public $success;
	public $pending;
	public $failure;

	function __construct(){
	}

	public function getSuccessUrl(){
		return $this->success;
	}
	public function setSuccessUrl($success){
		$this->success = $success;		
	}
	
	public function getPendingUrl(){
		return $this->pending;
	}
	public function setPendingUrl($pending){
		$this->pending = $pending;		
	}

	
	public function getFailureUrl(){
		return $this->failure;
	}
	public function setFailureUrl($failure){
		$this->failure = $failure;		
	}



}
