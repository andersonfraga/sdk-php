<?php
//services require
require_once "../../../src/services/checkoutService.php";
require_once "../../../src/services/authService.php";
//required classes
require_once "../../../src/classes/accessData.php";
require_once "../../../src/classes/checkoutPreferenceData.php";
require_once "../../../src/classes/checkoutPreferenceDataItems.php";
require_once "../../../src/classes/checkoutPreferenceDataPayer.php";
require_once "../../../src/classes/checkoutPreferenceDataBackUrls.php";
require_once "../../../src/classes/checkoutPreferenceDataPaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceDataExcludedPaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceDataExcludedPaymentTypes.php";

require_once "../../../src/classes/checkoutPreference.php";
require_once "../../../src/classes/checkoutPreferenceItems.php";
require_once "../../../src/classes/checkoutPreferencePayer.php";
require_once "../../../src/classes/checkoutPreferenceBackUrls.php";
require_once "../../../src/classes/checkoutPreferencePaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceExcludedPaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceExcludedPaymentTypes.php";
//this archive contains client credentials
require_once "../../../src/config.php";

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
	unset($checkoutPreferenceDataExcludedPaymentMethods);
	}

	$paymentTypes=explode(",",$_GET['payment_methods_exc_payment_types']);
	for($w=0; $w<sizeof($paymentTypes); $w++)
	{
	$checkoutPreferenceDataExcludedPaymentTypes = new CheckoutPreferenceDataExcludedPaymentTypes(); 
	$checkoutPreferenceDataExcludedPaymentTypes->setExcludedPaymentTypesId($paymentTypes[$w]);
	$checkoutPreferenceDataPaymentMethods->setExcludedPaymentTypes($checkoutPreferenceDataExcludedPaymentTypes);	
	unset($checkoutPreferenceDataPaymentTypes);
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
	$checkoutService = new CheckoutService();//new checkoutService instance
     	$checkoutPreference=$checkoutService->create_checkout_preference($checkoutPreferenceData,$_GET['access_token']);
	unset($checkoutService); //free instance
	unset($accessData);//free instance

	if(gettype($checkoutPreference)=='string')
		{
		throw new exception($checkoutPreference);//throw exception
		}	
	$items= $checkoutPreference->getItems(); 
	//////////////////////////////////////////////////////////////////////////
	//The next lines are just the rendering of the example data, we show you the interaction with the API result about the example!

		?>
		<!doctype html>
			  <body>
				<div  class="box" style="width:400px; align=center; margin:10px"><B>PREFERENCE CREATED</B></div>
				<code>
				<pre name="code" class="xml" style="margin-bottom:-20px">
		{
		 "id":"<?php echo $checkoutPreference->getId();?>",
		 "collector_id": <?php echo $checkoutPreference->getCollectorId();?>,
		 "external_reference": "<?php echo $checkoutPreference->getExternalReference();?>",
		 "subscription_plan_id": "<?php echo $checkoutPreference->getSubscriptionPlanId();?>", 
		 "expires": <?php echo $checkoutPreference->getExpires();?>,		
		 "expiration_date_from": "<?php echo $checkoutPreference->getExpirationDateFrom();?>",
		 "expiration_date_to": "<?php echo $checkoutPreference->getExpirationDateTo();?>",
		 "init_point": "<?php echo $checkoutPreference->getInitPoint();?>",
		 "date_created": "<?php echo $checkoutPreference->getDateCreated();?>",
		 "payer": {
			"name": "<?php echo $checkoutPreference->getPayer()->getName();?>",
			"surname": "<?php echo $checkoutPreference->getPayer()->getSurname();?>",
			"email": "<?php echo $checkoutPreference->getPayer()->getEmail();?>"
		    },
		 "items": [{		
			"id": "<?php echo $items[0]->getItemsId();?>",
			"currency_id": "<?php echo $items[0]->getCurrencyId();?>",
			"title": "<?php echo $items[0]->getTitle();?>",
			"picture_url": "<?php echo $items[0]->getPictureUrl();?>",
			"description": "<?php echo $items[0]->getDescription();?>",
			"quantity": <?php echo $items[0]->getQuantity();?>,
			"unit_price": <?php echo $items[0]->getUnitPrice();?> 
		    }],
		 "back_urls": {
			"success": "<?php echo $checkoutPreference->getBackUrls()->getSuccessUrl();?>",
			"pending": "<?php echo $checkoutPreference->getBackUrls()->getPendingUrl();?>",		
			"failure": "<?php echo $checkoutPreference->getBackUrls()->getFailureUrl();?>"		
		    },
		"payment_methods": {
			"excluded_payment_methods": [{
			</pre>		
			</code>	
			<?php 
			$excludedPaymentMethods=$checkoutPreference->getPaymentMethods()->getExcludedPaymentMethods();	
			for ($r=0; $r<sizeof($excludedPaymentMethods); $r++)
			{
			$excludedPaymentMethodsId=$excludedPaymentMethods[$r]->getExcludedPaymentMethodsId();		
			if($r!=sizeof($excludedPaymentMethods)-1)
				{?><code><pre name="code" class="xml" style="margin-bottom:-20px">
				"id": "<?php echo $excludedPaymentMethodsId;?>", 
				</pre></code><?php			
				}
				else
				{
				?><code><pre name="code" class="xml"  style="margin-bottom:-20px">
				"id": "<?php echo $excludedPaymentMethodsId;?>"
				</pre></code><?		
				}		
			}?>
			<code><pre name="code" class="xml" style="margin-bottom:-20px">
			}],
			"excluded_payment_types": [{
			</pre>		
			</code>	
			<?php 
			$excludedPaymentTypes=$checkoutPreference->getPaymentMethods()->getExcludedPaymentTypes();			
			for ($q=0; $q<sizeof($excludedPaymentTypes); $q++)
			{
			$excludedPaymentTypesId=$excludedPaymentTypes[$q]->getExcludedPaymenttypesId();		
			if($q==sizeof($excludedPaymentTypes)-1)
				{?><code><pre name="code" class="xml" style="margin-bottom:-20px">
				"id": "<?php echo $excludedPaymentTypesId;?>", 
				</pre></code><?php			
				}
				else
				{
				?><code><pre name="code" class="xml"  style="margin-bottom:-20px">
				"id": "<?php echo $excludedPaymentTypesId;?>"
				</pre></code><?		
				}		
				}?>
			<code><pre name="code" class="xml"  style="margin-bottom:-20px" >
			}],
		   }

		}
				</pre>
				</code>
			  </body>
		</html> 
	<?php
unset($checkoutPreference);  //free instance
}
/////////////////////////////////////
//The next lines handles the exception
catch (Exception $e) {//catch exception
 	echo $e->getMessage();	
}

	
