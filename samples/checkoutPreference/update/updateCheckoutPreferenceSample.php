<?php
//services require
require_once "../../../src/services/checkoutService.php";
require_once "../../../src/services/authService.php";
//this archive contains client credentials
require_once "../../../src/config.php";
//required classes
require_once "../../../src/classes/checkoutPreferenceData.php";
require_once "../../../src/classes/checkoutPreferenceDataItems.php";
require_once "../../../src/classes/checkoutPreferenceDataPayer.php";
require_once "../../../src/classes/checkoutPreferenceDataBackUrls.php";
require_once "../../../src/classes/checkoutPreferenceDataPaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceDataExcludedPaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceDataExcludedPaymentTypes.php";


//function to get preference values
function getPreferenceValues(){

	$checkoutPreferenceDataItems = new CheckoutPreferenceDataItems(); 
	$checkoutPreferenceDataItems->setItemsId(isset($_GET['item_id'])&&trim($_GET['item_id'])!=""?$_GET['item_id']:"");
	$checkoutPreferenceDataItems->setTitle(isset($_GET['item_title'])&&trim($_GET['item_title'])!=""?$_GET['item_title']:"");
	$checkoutPreferenceDataItems->setDescription(isset($_GET['item_description'])&&trim($_GET['item_description'])!=""?$_GET['item_description']:"");
	$checkoutPreferenceDataItems->setQuantity(isset($_GET['item_quantity'])&&trim($_GET['item_quantity'])!=""?(int)$_GET['item_quantity']:"");
	$checkoutPreferenceDataItems->setUnitPrice(isset($_GET['item_unit_price'])&&trim($_GET['item_unit_price'])!=""?(float)$_GET['item_unit_price']:"");
	$checkoutPreferenceDataItems->setCurrencyId( isset($_GET['item_currency_id'])&&trim($_GET['item_currency_id'])!=""?$_GET['item_currency_id']:"");
	$checkoutPreferenceDataItems->setPictureUrl(isset($_GET['item_picture_url'])&&trim($_GET['item_picture_url'])!=""?$_GET['item_picture_url']:"");

	$checkoutPreferenceDataPayer = new CheckoutPreferenceDataPayer(); 
	$checkoutPreferenceDataPayer->setName(isset($_GET['payer_name'])&&trim($_GET['payer_name'])!=""?$_GET['payer_name']:"");
	$checkoutPreferenceDataPayer->setSurname(isset($_GET['payer_surname'])&&trim($_GET['payer_surname'])!=""?$_GET['payer_surname']:"");
	$checkoutPreferenceDataPayer->setEmail(isset($_GET['payer_email'])&&trim($_GET['payer_email'])!=""?$_GET['payer_email']:"");

	$checkoutPreferenceDataBackUrls = new CheckoutPreferenceDataBackUrls(); 
	$checkoutPreferenceDataBackUrls->setSuccessUrl(isset($_GET['back_urls_success'])&&trim($_GET['back_urls_success'])!=""?$_GET['back_urls_success']:"");
	$checkoutPreferenceDataBackUrls->setPendingUrl(isset($_GET['back_urls_pending'])&&trim($_GET['back_urls_pending'])!=""?$_GET['back_urls_pending']:"");


	$checkoutPreferenceDataPaymentMethods = new CheckoutPreferenceDataPaymentMethods(); 
	
	$paymentMethods=explode(",",$_GET['payment_methods_exc_payment_methods']);	
	for($q=0; $q<sizeof($paymentMethods); $q++)
	{
	$checkoutPreferenceDataExcludedPaymentMethods = new CheckoutPreferenceDataExcludedPaymentMethods(); 
	$checkoutPreferenceDataExcludedPaymentMethods->setExcludedPaymentMethodsId($paymentMethods[$q]);
	$checkoutPreferenceDataPaymentMethods->setExcludedPaymentMethods($checkoutPreferenceDataExcludedPaymentMethods);
	unset($checkoutPreferenceDataExcludedPaymentMethods);//free instance
	}

	$paymentTypes=explode(",",$_GET['payment_methods_exc_payment_types']);
	for($w=0; $w<sizeof($paymentTypes); $w++)
	{
	$checkoutPreferenceDataExcludedPaymentTypes = new CheckoutPreferenceDataExcludedPaymentTypes(); 
	$checkoutPreferenceDataExcludedPaymentTypes->setExcludedPaymentTypesId($paymentTypes[$w]);
	$checkoutPreferenceDataPaymentMethods->setExcludedPaymentTypes($checkoutPreferenceDataExcludedPaymentTypes);	
	unset($checkoutPreferenceDataPaymentTypes);//free instance
	}
	$checkoutPreferenceDataPaymentMethods->setInstallments(isset($_GET['payment_methods_installments'])&&trim($_GET['payment_methods_installments'])!=""?(int)$_GET['payment_methods_installments']:null);

	$checkoutPreferenceData = new CheckoutPreferenceData(); 
	$checkoutPreferenceData->setExternalReference(isset($_GET['external_reference'])&&trim($_GET['external_reference'])!=""?$_GET['external_reference']:"");
	$checkoutPreferenceData->setExpires(isset($_GET['expires'])&&trim($_GET['expires'])!=""?$_GET['expires']:false); 
	$checkoutPreferenceData->setItems($checkoutPreferenceDataItems);
	$checkoutPreferenceData->setPayer($checkoutPreferenceDataPayer);	
	$checkoutPreferenceData->setBackUrls($checkoutPreferenceDataBackUrls);
	$checkoutPreferenceData->setPaymentMethods($checkoutPreferenceDataPaymentMethods);
			
	return $checkoutPreferenceData;
}
//Init
//The next lines are necesary to call the sevice
try {
	
	$checkoutPreferenceData = getPreferenceValues();
	$checkoutService = new CheckoutService();
	$checkoutPreferenceStatus=$checkoutService->update_checkout_preference($_GET['preference_id'],$checkoutPreferenceData,$_GET['access_token']);
	unset($updatePreference); //free instance
	unset($accessData);//free instance

	if(gettype($checkoutPreferenceStatus)=='string')
		{
		throw new exception($checkoutPreference);//throw exception
		}
	//////////////////////////////////////////////////////////////////////////
	//The next lines are just the rendering of the example data, we show you the interaction with the API result about the example!

	?>
	<!doctype html>
	  <body>
		<div  class="box" style="width:400px align=center"><B>PREFERENCE UPDATED</B></div>
		<div>The preference has been updated successfully</div>	

	 </body>
	</html>
	<? 
unset($checkoutPreferenceStatus);	
}
/////////////////////////////////////
//The next lines handles the exception
catch (Exception $e) {//catch exception
 	echo $e->getMessage();
}

