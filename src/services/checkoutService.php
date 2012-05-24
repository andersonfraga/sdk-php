<?php
require_once(realpath(dirname(__FILE__) . "/../classes/checkoutPreference.php"));
require_once(realpath(dirname(__FILE__) . "/../classes/checkoutPreferencePayer.php"));
require_once(realpath(dirname(__FILE__) . "/../classes/checkoutPreferenceItems.php"));
require_once(realpath(dirname(__FILE__) . "/../classes/checkoutPreferencePaymentMethods.php"));
require_once(realpath(dirname(__FILE__) . "/../classes/checkoutPreferenceBackUrls.php"));
require_once(realpath(dirname(__FILE__) . "/../classes/checkoutPreferenceExcludedPaymentMethods.php"));
require_once(realpath(dirname(__FILE__) . "/../classes/checkoutPreferenceExcludedPaymentTypes.php"));

class CheckoutService {
	public function create_checkout_preference ($checkoutPreferenceData,$accessToken) {//checkoutPreferenceData must be a CheckoutPreferenceData Object, accessToken must be string

		$postPreferenceURL = "https://api.mercadolibre.com/checkout/preferences?access_token=".$accessToken; //checkout API

		// START Request
		$preferenceConnect = curl_init();
		curl_setopt($preferenceConnect, CURLOPT_RETURNTRANSFER, true); //return the transference value like a string
		curl_setopt($preferenceConnect, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));//sets the header
		curl_setopt($preferenceConnect, CURLOPT_URL, $postPreferenceURL); //Preference API
		curl_setopt($preferenceConnect, CURLOPT_POSTFIELDS, json_encode($checkoutPreferenceData));  //preference creation data

		$preferenceContent = curl_exec($preferenceConnect);//execute the conection
		$preferenceHttpcode = curl_getinfo($preferenceConnect, CURLINFO_HTTP_CODE);//status

		if($preferenceHttpcode != 201)
	 	{
	        throw new Exception($preferenceContent);//throw the exception
	 	}
		curl_close($preferenceConnect); //conection close
		// Request OK
		$preferenceContent=json_decode(($preferenceContent),true);//converts string to json
		//set object properties
		$checkoutPreferenceItems = new CheckoutPreferenceItems();
		$checkoutPreferenceItems->setItemsId(isset($preferenceContent['items'][0]['id'])
			? $preferenceContent['items'][0]['id']
			: "");

		$checkoutPreferenceItems->setTitle(isset($preferenceContent['items'][0]['title'])
			? $preferenceContent['items'][0]['title']
			: "");

		$checkoutPreferenceItems->setDescription(isset($preferenceContent['description'][0]['id'])
			? $preferenceContent['description'][0]['id']
			: "");

		$checkoutPreferenceItems->setQuantity(isset($preferenceContent['items'][0]['quantity'])
			? (int) $preferenceContent['items'][0]['quantity']
			: "");

		$checkoutPreferenceItems->setUnitPrice(isset($preferenceContent['items'][0]['unit_price'])
			? $preferenceContent['items'][0]['unit_price']
			: "");

		$checkoutPreferenceItems->setCurrencyId(isset($preferenceContent['items'][0]['currency_id'])
			? $preferenceContent['items'][0]['currency_id']
			: "");

		$checkoutPreferenceItems->setPictureUrl(isset($preferenceContent['items'][0]['picture_url'])
			? $preferenceContent['items'][0]['picture_url']
			: "");

		$checkoutPreferencePayer = new CheckoutPreferencePayer();
		$checkoutPreferencePayer->setName(isset($preferenceContent['payer']['name'])
			? $preferenceContent['payer']['name']
			: "");

		$checkoutPreferencePayer->setSurname(isset($preferenceContent['payer']['surname'])
			? $preferenceContent['payer']['surname']
			: "");

		$checkoutPreferencePayer->setEmail(isset($preferenceContent['payer']['email'])
			? $preferenceContent['payer']['email']
			: "");

		$checkoutPreferenceBackUrls = new CheckoutPreferenceBackUrls();
		$checkoutPreferenceBackUrls->setSuccessUrl(isset($preferenceContent['back_urls']['success'])
			? $preferenceContent['back_urls']['success']
			: "");

		$checkoutPreferenceBackUrls->seTpendingUrl(isset($preferenceContent['back_urls']['pending'])
			? $preferenceContent['back_urls']['pending']
			: "");

		$checkoutPreferenceBackUrls->setFailureUrl(isset($preferenceContent['back_urls']['failure'])
			? $preferenceContent['back_urls']['failure']
			: "");


		$checkoutPreferencePaymentMethods = new CheckoutPreferencePaymentMethods();
		$checkoutPreferencePaymentMethods->setInstallments(isset($preferenceContent['payment_methods']['installments'])
			? $preferenceContent['payment_methods']['installments']
			: "");

		for($q=0; $q<sizeof($preferenceContent['payment_methods']['excluded_payment_methods']); $q++)
		{
			$checkoutPreferenceExcludedPaymentMethods = new CheckoutPreferenceExcludedPaymentMethods();

			$checkoutPreferenceExcludedPaymentMethods->setExcludedPaymentMethodsId(
				isset($preferenceContent['payment_methods']['excluded_payment_methods'][$q]['id'])
					? $preferenceContent['payment_methods']['excluded_payment_methods'][$q]['id']
					: ""
			);

			$checkoutPreferencePaymentMethods->setExcludedPaymentMethods($checkoutPreferenceExcludedPaymentMethods);
			unset($checkoutPreferenceExcludedPaymentMethods);
		}

		for($w=0; $w<sizeof($preferenceContent['payment_methods']['excluded_payment_types']); $w++)
		{
			$checkoutPreferenceExcludedPaymentTypes = new CheckoutPreferenceExcludedPaymentTypes();
			$checkoutPreferenceExcludedPaymentTypes->setExcludedPaymentTypesId(
				isset($preferenceContent['payment_methods']['excluded_payment_types'][$w]['id'])
					? $preferenceContent['payment_methods']['excluded_payment_types'][$w]['id']
					: ""
			);

			$checkoutPreferencePaymentMethods->setExcludedPaymentTypes($checkoutPreferenceExcludedPaymentTypes);
			unset($checkoutPreferenceExcludedPaymentTypes);
		}

		$checkoutPreference = new CheckoutPreference();
		$checkoutPreference->setId(isset($preferenceContent['id']) ? $preferenceContent['id'] : "");

		$checkoutPreference->setExternalReference(isset($preferenceContent['external_reference'])
			? $preferenceContent['external_reference']
			: "");

		$checkoutPreference->setExpires(isset($preferenceContent['expires']) ? $preferenceContent['expires'] : false);

		$checkoutPreference->setCollectorId(isset($preferenceContent['collector_id'])
			? $preferenceContent['collector_id']
			: "");

		$checkoutPreference->setSubscriptionPlanId(isset($preferenceContent['subscription_plan_id'])
			? $preferenceContent['subscription_plan_id']
			: "");

		$checkoutPreference->setExpirationDateFrom(isset($preferenceContent['expiration_date_from'])
			? $preferenceContent['expiration_date_from']
			: "");

		$checkoutPreference->setExpirationDateTo(isset($preferenceContent['expiration_date_to'])
			? $preferenceContent['expiration_date_to']
			: "");

		$checkoutPreference->setInitPoint(isset($preferenceContent['init_point'])
			? $preferenceContent['init_point']
			: "");

		$checkoutPreference->setDateCreated(isset($preferenceContent['date_created'])
			? $preferenceContent['date_created']
			: "");

		$checkoutPreference->setItems($checkoutPreferenceItems);
		$checkoutPreference->setPayer($checkoutPreferencePayer);
		$checkoutPreference->setBackUrls($checkoutPreferenceBackUrls);
		$checkoutPreference->setPaymentMethods($checkoutPreferencePaymentMethods);

		return $checkoutPreference;//returns a checkoutPreference Object
	}


	public function get_checkout_preference($preferenceId,$accessToken) {// both must be strings

		$getPreferenceURL = "https://api.mercadolibre.com/checkout/preferences/".$preferenceId."?access_token=".$accessToken; //checkout API
		// START Request
		$getPreferenceConnect = curl_init();
		curl_setopt($getPreferenceConnect, CURLOPT_RETURNTRANSFER, true); //return the transference value like a string
		curl_setopt($getPreferenceConnect, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));//sets the header
		curl_setopt($getPreferenceConnect, CURLOPT_URL, $getPreferenceURL);//Preference API

		$preferenceContent = curl_exec($getPreferenceConnect);//execute the conection
		$preferenceHttpcode = curl_getinfo($getPreferenceConnect, CURLINFO_HTTP_CODE);//status

		if($preferenceHttpcode != 200)
	 	{
	        throw new Exception($preferenceContent);//throw the exception
	 	}

		curl_close($getPreferenceConnect); //conection close
		//Request Ok
		$preferenceContent=json_decode(($preferenceContent),true);//converts string to json
		//set object properties
		$checkoutPreferenceItems = new CheckoutPreferenceItems();
		$checkoutPreferenceItems->setItemsId(isset($preferenceContent['items'][0]['id'])
			? $preferenceContent['items'][0]['id']
			: "");

		$checkoutPreferenceItems->setTitle(isset($preferenceContent['items'][0]['title'])
			? $preferenceContent['items'][0]['title']
			: "");

		$checkoutPreferenceItems->setDescription(isset($preferenceContent['description'][0]['id'])
			? $preferenceContent['description'][0]['id']
			: "");

		$checkoutPreferenceItems->setQuantity(isset($preferenceContent['items'][0]['quantity'])
			? (int) $preferenceContent['items'][0]['quantity']
			: "");

		$checkoutPreferenceItems->setUnitPrice(isset($preferenceContent['items'][0]['unit_price'])
			? $preferenceContent['items'][0]['unit_price']
			: "");

		$checkoutPreferenceItems->setCurrencyId(isset($preferenceContent['items'][0]['currency_id'])
			? $preferenceContent['items'][0]['currency_id']
			: "");

		$checkoutPreferenceItems->setPictureUrl(isset($preferenceContent['items'][0]['picture_url'])
			? $preferenceContent['items'][0]['picture_url']
			: "");

		$checkoutPreferencePayer = new CheckoutPreferencePayer();
		$checkoutPreferencePayer->setName(isset($preferenceContent['payer']['name'])
			? $preferenceContent['payer']['name']
			: "");

		$checkoutPreferencePayer->setSurname(isset($preferenceContent['payer']['surname'])
			? $preferenceContent['payer']['surname']
			: "");

		$checkoutPreferencePayer->setEmail(isset($preferenceContent['payer']['email'])
			? $preferenceContent['payer']['email']
			: "");

		$checkoutPreferenceBackUrls = new CheckoutPreferenceBackUrls();
		$checkoutPreferenceBackUrls->setSuccessUrl(isset($preferenceContent['back_urls']['success'])
			? $preferenceContent['back_urls']['success']
			: "");

		$checkoutPreferenceBackUrls->seTpendingUrl(isset($preferenceContent['back_urls']['pending'])
			? $preferenceContent['back_urls']['pending']
			: "");

		$checkoutPreferenceBackUrls->setFailureUrl(isset($preferenceContent['back_urls']['failure'])
			? $preferenceContent['back_urls']['failure']
			: "");


		$checkoutPreferencePaymentMethods = new CheckoutPreferencePaymentMethods();
		$checkoutPreferencePaymentMethods->setInstallments(isset($preferenceContent['payment_methods']['installments'])
			? $preferenceContent['payment_methods']['installments']
			: "");
		for($q=0; $q<sizeof($preferenceContent['payment_methods']['excluded_payment_methods']); $q++)
		{
			$checkoutPreferenceExcludedPaymentMethods = new checkoutPreferenceExcludedPaymentMethods();
			$checkoutPreferenceExcludedPaymentMethods->setExcludedPaymentMethodsId(
				isset($preferenceContent['payment_methods']['excluded_payment_methods'][$q]['id'])
					? $preferenceContent['payment_methods']['excluded_payment_methods'][$q]['id']
					: ""
			);

			$checkoutPreferencePaymentMethods->setExcludedPaymentMethods($checkoutPreferenceExcludedPaymentMethods);
			unset($checkoutPreferenceExcludedPaymentMethods);
		}

		for($w=0; $w<sizeof($preferenceContent['payment_methods']['excluded_payment_types']); $w++)
		{
			$checkoutPreferenceExcludedPaymentTypes = new checkoutPreferenceExcludedPaymentTypes();
			$checkoutPreferenceExcludedPaymentTypes->setExcludedPaymentTypesId(
				isset($preferenceContent['payment_methods']['excluded_payment_types'][$w]['id'])
					? $preferenceContent['payment_methods']['excluded_payment_types'][$w]['id']
					: ""
			);

			$checkoutPreferencePaymentMethods->setExcludedPaymentTypes($checkoutPreferenceExcludedPaymentTypes);
			unset($checkoutPreferenceExcludedPaymentTypes);
		}

		$checkoutPreference = new CheckoutPreference();
		$checkoutPreference->setId(isset($preferenceContent['id']) ? $preferenceContent['id'] : "");

		$checkoutPreference->setExternalReference(isset($preferenceContent['external_reference'])
			? $preferenceContent['external_reference']
			: "");

		$checkoutPreference->setExpires(isset($preferenceContent['expires'])?$preferenceContent['expires']:false);
		$checkoutPreference->setCollectorId(isset($preferenceContent['collector_id'])
			? $preferenceContent['collector_id']
			: "");

		$checkoutPreference->setSubscriptionPlanId(isset($preferenceContent['subscription_plan_id'])
			? $preferenceContent['subscription_plan_id']
			: "");

		$checkoutPreference->setExpirationDateFrom(isset($preferenceContent['expiration_date_from'])
			? $preferenceContent['expiration_date_from']
			: "");

		$checkoutPreference->setExpirationDateTo(isset($preferenceContent['expiration_date_to'])
			? $preferenceContent['expiration_date_to']
			: "");

		$checkoutPreference->setInitPoint(isset($preferenceContent['init_point'])
			? $preferenceContent['init_point']
			: "");

		$checkoutPreference->setDateCreated(isset($preferenceContent['date_created'])
			? $preferenceContent['date_created']
			: "");

		$checkoutPreference->setItems($checkoutPreferenceItems);
		$checkoutPreference->setPayer($checkoutPreferencePayer);
		$checkoutPreference->setBackUrls($checkoutPreferenceBackUrls);
		$checkoutPreference->setPaymentMethods($checkoutPreferencePaymentMethods);

		return $checkoutPreference;//returns a checkoutPreference Object
	}


	public function update_checkout_preference ($preferenceId,$updateData,$accessToken) { // id y accessToken must be string, updatedata must be checkoutPreferenceData Object

		$putPreferenceURL = "https://api.mercadolibre.com/checkout/preferences/".$preferenceId."?access_token=".$accessToken; //checkout API

		// START Request
		$putPreferenceConnect = curl_init();
		curl_setopt($putPreferenceConnect, CURLOPT_CUSTOMREQUEST, "PUT"); //indicates its a preference update
		curl_setopt($putPreferenceConnect, CURLOPT_RETURNTRANSFER, true); //return the transference value like a string
		curl_setopt($putPreferenceConnect, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));//sets the header
		curl_setopt($putPreferenceConnect, CURLOPT_URL, $putPreferenceURL);//preference update data
		curl_setopt($putPreferenceConnect, CURLOPT_POSTFIELDS, json_encode($updateData)); //data to update


		$preferenceContent = curl_exec($putPreferenceConnect);//execute the conection
		$preferenceHttpcode = curl_getinfo($putPreferenceConnect, CURLINFO_HTTP_CODE);//status

		if($preferenceHttpcode != 201)
	 	{
	        throw new Exception($preferenceContent);//throw the exception
	 	}

		curl_close($putPreferenceConnect); //conection close

		return $preferenceHttpcode; //returns a json

	}


}

?>

