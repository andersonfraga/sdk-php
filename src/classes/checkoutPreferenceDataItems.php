
<?
class CheckoutPreferenceDataItems {

	public $id;
	public $title;
	public $description;
	public $quantity;
	public $unit_price;	
	public $currency_id;
	public $picture_url;

	function __construct(){

	}
	
	
	public function getItemsId(){
		return $this->id;
	}
	public function setItemsId($items_id){
		$this->id = $items_id;		
	}

	
	public function getTitle(){
		return $this->title;
	}
	public function setTitle($title){
		$this->title = $title;		
	}


	public function getDescription(){
		return $this->description;
	}
	public function setDescription($description){
		$this->description = $description;		
	}


	public function getQuantity(){
		return $this->quantity;
	}
	public function setQuantity($itemsQuantity){
		$this->quantity = $itemsQuantity;		
	}

	
	public function getUnitPrice(){
		return $this->unit_price;
	}
	public function setUnitPrice($itemsUnitPrice){
		$this->unit_price = $itemsUnitPrice;		
	}


	public function getCurrencyId(){
		return $this->currency_id;
	}
	public function setCurrencyId($itemsCurrencyId){
		$this->currency_id = $itemsCurrencyId;		
	}


	public function getPictureUrl(){
		return $this->picture_url;
	}
	public function setPictureUrl($itemsPictureUrl){
		$this->picture_url = $itemsPictureUrl;		
	}


	

}
