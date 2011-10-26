
<?
class CheckoutPreferenceDataPayer{
	
	public $name;
	public $surname;
	public $email;

	function __construct(){
	}

	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;		
	}
	
	public function getSurname(){
		return $this->surname;
	}
	public function setSurname($surname){
		$this->surname = $surname;		
	}

	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;		
	}




}

