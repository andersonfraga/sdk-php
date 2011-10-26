<?


class Collection{

	public $id;
	public $site_id;
	public $date_created;
	public $date_approved;
	public $last_modified;
	public $collector_id;
	public $money_release_date;
	public $operation_type;
	public $payer;
	public $external_reference;
	public $reason;
	public $transaction_amount;
	public $currency_id;
	public $shipping_cost;
	public $mercadopago_fee;
	public $net_received_amount;
	public $status;
	public $status_detail;
	public $released;
	public $payment_type;
	public $marketplace;    
       

	function __construct(){
	}


	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;		
	}
	
	
	public function getSiteId(){
		return $this->site_id;
	}
	public function setSiteId($siteId){
		$this->site_id = $siteId;		
	}


	public function getExternalreference(){
		return $this->external_reference;
	}
	public function setExternalReference($externalReference){
		$this->external_reference = $externalReference;		
	}

		
	public function getCollectorId(){
		return $this->collector_id;
	}
	public function setCollectorId($collectorId){
		$this->collector_id = $collectorId;		
	}

	
	public function getDateCreated(){
		return $this->date_created;
	}
	public function setDateCreated($dateCreated){
		$this->date_created = $dateCreated;		
	}


	public function getDateApproved(){
		return $this->date_approved;
	}
	public function setDateApproved($dateApproved){
		$this->date_approved= $dateApproved;		
	}


	public function getLastModified(){
		return $this->last_modified;
	}
	public function setLastModified($lastModified){
		$this->last_modified= $lastModified;		
	}


	public function getMoneyReleaseDate(){
		return $this->money_release_date;
	}
	public function setMoneyReleaseDate($moneyReleaseDate){
		$this->money_release_date= $moneyReleaseDate;		
	}


	public function getOperationType(){
		return $this->operation_type;
	}
	public function setOperationType($operationType){
		$this->operation_type= $operationType;		
	}


	public function getPayer(){
		return $this->payer;
	}
	public function setPayer($payer){
		$this->payer = $payer;		
	}


	public function getCurrencyId(){
		return $this->currency_id;
	}
	public function setCurrencyId($itemsCurrencyId){
		$this->currency_id = $itemsCurrencyId;		
	}


	public function getReason(){
		return $this->reason;
	}
	public function setReason($reason){
		$this->reason = $reason;		
	}


	public function getTransactionAmount(){
		return $this->transaction_amount;
	}
	public function setTransactionAmount($transactionAmount){
		$this->transaction_amount= $transactionAmount;		
	}


	public function getShippingCost(){
		return $this->shipping_cost;
	}
	public function setShippingCost($shippingCost){
		$this->shipping_cost= $shippingCost;		
	}


	public function getMercadopagoFee(){
		return $this->mercadopago_fee;
	}
	public function setMercadopagoFee($mercadopagoFee){
		$this->mercadopago_fee= $mercadopagoFee;		
	}


	public function getStatus(){
		return $this->status;
	}
	public function setStatus($status){
		$this->status= $status;		
	}


	public function getStatusDetail(){
		return $this->status_detail;
	}
	public function setStatusDetail($statusDetail){
		$this->status_detail= $statusDetail;		
	}


	public function getNetReceivedAmount(){
		return $this->net_received_amount;
	}
	public function setNetReceivedAmount($netReceivedAmount){
		$this->net_received_amount= $netReceivedAmount;		
	}


	public function getReleased(){
		return $this->released;
	}
	public function setReleased($released){
		$this->released= $released;		
	}


	public function getPaymentType(){
		return $this->payment_type;
	}
	public function setPaymentType($paymentType){
		$this->payment_type= $paymentType;		
	}

	
	public function getMarketplace(){
		return $this->marketplace;
	}
	public function setMarketplace($marketplace){
		$this->marketplace= $marketplace;		
	}

}

