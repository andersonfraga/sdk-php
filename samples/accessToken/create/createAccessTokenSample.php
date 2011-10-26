<?php
//services require
require_once "../../../src/services/authService.php";
//this archive contains client credentials
require_once "../../../src/config.php";
//classes requireds
require_once "../../../src/classes/accessData.php";

//Init
//The next lines are necesary to call the sevice

try {
	$authService = new AuthService();//new instance Auth class
	$accessData= $authService->create_access_data(CLIENT_ID,CLIENT_SECRET);
	unset($authService); //free instance
	if(gettype($accessData)=='string')
		{
		throw new exception($checkoutPreference);//throw exception
		}
	//////////////////////////////////////////////////////////////////////////
	//The next lines are just the rendering of the example data, we show you the interaction with the API result about the example!
	?>
	<!doctype html>
		 <body>
		   <div  class="box" style="width:400px align=center"><B>ACCESS_TOKEN CREATION</B></div>
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
/////////////////////////////////////
//The next lines handles the exception
}
catch (Exception $e) {//catch exception
 	echo $e->getMessage();
	
}

