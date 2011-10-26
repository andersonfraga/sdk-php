<?php
//services requires
require_once "../../../src/services/authService.php";
//this archive contains client credentials
require_once "../../../src/config.php";
//required classes
require_once "../../../src/classes/accessData.php";

//Init
//The next lines are necesary to call the sevice
$refreshToken=$_GET['refresh_token'];

try {	
	$authService = new AuthService();//new instance Auth class
	$accessData= $authService->refresh_access_token(CLIENT_ID,CLIENT_SECRET, $refreshToken);
	unset($authService); //free instance
	if(gettype($accessData)=='string')
		{
		throw new exception($checkoutPreference);//throw exception
		}
	///////////////////////////////////////////////////////////////////
	//The next lines are just the rendering of the example data, we show you the interaction with the API result about the example!
	?>
		<!doctype html>
		 <body>
		   <div  class="box" style="width:400px align=center"><B>REFRESH ACCESS_TOKEN</B></div>
		    <code>
			<pre name="code" class="xml">
		{
		 "access_token":"<?php echo $accessData->getAccessToken();?>",
		 "token_type": "<?php echo $accessData->getTokenType();?>",
		 "expires_in": "<?php echo $accessData->getExpiresIn();?>",
		 "scope": "<?php echo $accessData->getScope();?>",
		 "refresh_token": "<?php echo $accessData->getRefreshToken();?>"    
		}
			</pre>
		   </code>
		 </body>
	       </html>
<? 
}
/////////////////////////////////////
//The next lines handles the exception
catch (Exception $e) {//catch exception
 	echo $e->getMessage();
	
}
