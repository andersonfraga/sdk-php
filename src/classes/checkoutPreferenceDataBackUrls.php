<?
class CheckoutPreferenceDataBackUrls{
	
	public $success;
	public $pending;

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



}
