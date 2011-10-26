
<?
class CollectionPayerPhone{
	
	public $area_code;
        public $number;
        public $extension;

	function __construct(){
	}


	public function getAreaCode(){
		return $this->area_code;
	}
	public function setAreaCode($areaCode){
		$this->area_code = $areaCode;		
	}


	public function getNumber(){
		return $this->number;
	}
	public function setNumber($number){
		$this->number = $number;		
	}
	

	public function getExtension(){
		return $this->extension;
	}
	public function setExtension($extension){
		$this->extension = $extension;		
	}
}
