<?php
//required services
require_once "../../../src/services/checkoutService.php";
require_once "../../../src/services/authService.php";
//this archive contains client credentials
require_once "../../../src/config.php";
//required classes
require_once "../../../src/classes/checkoutPreference.php";
require_once "../../../src/classes/checkoutPreference.php";
require_once "../../../src/classes/checkoutPreferenceItems.php";
require_once "../../../src/classes/checkoutPreferencePayer.php";
require_once "../../../src/classes/checkoutPreferenceBackUrls.php";
require_once "../../../src/classes/checkoutPreferencePaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceExcludedPaymentMethods.php";
require_once "../../../src/classes/checkoutPreferenceExcludedPaymentTypes.php";

//Init
//The next lines are necesary to call the sevice
try {
	$checkoutService = new CheckoutService(); //new CheckoutService instance
	$checkoutPreference=$checkoutService->get_checkout_preference($_GET['preference_id'],$_GET['access_token']);
	unset($checkoutService); //free instance
	unset($accessData);//free instance
	if(gettype($checkoutPreference)=='string')
		{
		throw new exception($checkoutPreference);//throw exception
		}	
	$items= $checkoutPreference->getItems(); 
	$paymentMethods=$checkoutPreference->getPaymentMethods();
	//////////////////////////////////////////////////////////////////////////
	//The next lines are just the rendering of the example data, we show you the interaction with the API result about the example!

		?>
		<!doctype html>
			  <body>
				<div  class="box" style="width:400px; align=center; margin:10px"><B>GET PREFERENCE</B></div>
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
			$excludedPaymentMethods=$paymentMethods->getExcludedPaymentMethods();	
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
			$excludedPaymentTypes=$paymentMethods->getExcludedPaymentTypes();			
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
unset($checkoutPreference); //free instance
}
/////////////////////////////////////
//The next lines handles the exception
catch (Exception $e) {//catch exception
 	echo $e->getMessage(); 
}




