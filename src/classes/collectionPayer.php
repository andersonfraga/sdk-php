
<?
class CollectionPayer{
	
	public $id;	
	public $nickname;
	public $first_name;
	public $last_name;
	public $email;
	public $phone;

	function __construct(){
	}


	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;		
	}


	public function getNickname(){
		return $this->nickname;
	}
	public function setNickname($nickname){
		$this->nickname = $nickname;		
	}
	

	public function getFirstName(){
		return $this->first_name;
	}
	public function setFirstName($firstName){
		$this->first_name = $firstName;		
	}


	public function getLastName(){
		return $this->last_name;
	}
	public function setLastName($lastName){
		$this->last_name = $lastName;		
	}


	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;		
	}

	
	public function getPhone(){
		return $this->phone;
	}
	public function setPhone($phone){
		$this->phone = $phone;		
	}




}

