<?php
class AccessData {

	private $access_token;
	private $token_type;
	private $expires_in;
	private $scope;
	private $refresh_token;
	
	function __construct(){
		}


	public function getAccessToken(){
		return $this->access_token;
	}
	public function setAccessToken($accessToken){
		$this->access_token = $accessToken;	
	}	


	public function getTokenType(){
		return $this->token_type;
	}
	public function setTokenType($tokenType){
		$this->token_type = $tokenType;	
	}


	public function getExpiresIn(){
		return $this->expires_in;
	}
	public function setExpiresIn($expiresIn){
		$this->expires_in = $expiresIn;	
	}


	public function getScope(){
		return $this->scope;
	}
	public function setScope($scope){
		$this->scope = $scope;	
	}


	public function getRefreshToken(){
		return $this->refresh_token;
	}
	public function setRefreshToken($refreshToken){
		$this->refresh_token = $refreshToken;	
	}

}
?>
