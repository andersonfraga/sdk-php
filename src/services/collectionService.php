
<?php
require_once "../../../src/classes/collection.php";
require_once "../../../src/classes/collectionPayer.php";
require_once "../../../src/classes/collectionPayerPhone.php";


class CollectionService {
	
	public function search_collection ($filters,$accessToken) { //filters must be an array, accessToken must be a string
                $siteId = $filters['site_id'];
		$external_reference = $filters['external_reference'];
		$id = $filters['id'];
		$offset = $filters['offset'];
		$limit = $filters['limit'];
		$searchCollectionURL = "https://api.mercadolibre.com/collections/search?site_id=".$siteId."&id=".$id."&external_reference=".$external_reference."&access_token=".$accessToken."&offset=".$offset."&limit=".$limit; //collection API

		// START Request
		$searchCollectionConnect = curl_init();
		curl_setopt($searchCollectionConnect, CURLOPT_RETURNTRANSFER, true);//return the transference value like a string
		curl_setopt($searchCollectionConnect, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));//sets header
		curl_setopt($searchCollectionConnect, CURLOPT_URL, $searchCollectionURL);//collection API

		$collectionContent = curl_exec($searchCollectionConnect);  //execute the conection
		$collectionHttpcode = curl_getinfo($searchCollectionConnect, CURLINFO_HTTP_CODE);//status

		if($collectionHttpcode != 200)
	 	{
	        throw new Exception($collectionContent);//throw the exception
	 	}
		
		curl_close($searchCollectionConnect); //conection close


		$collectionContent=json_decode(($collectionContent),true);//converts string to json
		
		$collectionContentResults = $collectionContent['results'];
		for ($i=0; $i<sizeof($collectionContentResults); $i++)
		{
		$collectionContentResultslist = $collectionContentResults[$i];
		//set object properties	
		$collectionPayerPhone = new CollectionPayerPhone();
		$collectionPayerPhone->setAreaCode(isset($collectionContentResultslist['collection']['payer']['phone']['area_code'])?$collectionContentResultslist['collection']['payer']['phone']['area_code']:"");
		$collectionPayerPhone->setNumber(isset($collectionContentResultslist['collection']['payer']['phone']['number'])?$collectionContentResultslist['collection']['payer']['phone']['number']:"");
		$collectionPayerPhone->setExtension(isset($collectionContentResultslist['collection']['payer']['phone']['extension'])?$collectionContentResultslist['collection']['payer']['phone']['extension']:"");	
		
		
		$collectionPayer = new CollectionPayer();
		$collectionPayer->setId(isset($collectionContentResultslist['collection']['payer']['id'])?$collectionContentResultslist['collection']['payer']['id']:"");
		$collectionPayer->setNickname(isset($collectionContentResultslist['collection']['payer']['nickname'])?$collectionContentResultslist['collection']['payer']['nickname']:"");
		$collectionPayer->setFirstName(isset($collectionContentResultslist['collection']['payer']['first_name'])?$collectionContentResultslist['collection']['payer']['first_name']:"");
		$collectionPayer->setLastName(isset($collectionContentResultslist['collection']['payer']['last_name'])?$collectionContentResultslist['collection']['payer']['last_name']:"");
		$collectionPayer->setEmail(isset($collectionContentResultslist['collection']['payer']['email'])?$collectionContentResultslist['collection']['payer']['email']:"");
		$collectionPayer->setPhone($collectionPayerPhone);

		$collection = new Collection();
		$collection->setId(isset($collectionContentResultslist['collection']['id'])?$collectionContentResultslist['collection']['id']:"");
		$collection->setSiteId(isset($collectionContentResultslist['collection']['site_id'])?$collectionContentResultslist['collection']['site_id']:"");
		$collection->setDateCreated(isset($collectionContentResultslist['collection']['date_created'])?$collectionContentResultslist['collection']['date_created']:"");
		$collection->setDateApproved(isset($collectionContentResultslist['collection']['date_approved'])?$collectionContentResultslist['collection']['date_approved']:"");
		$collection->setLastModified(isset($collectionContentResultslist['collection']['last_modified'])?$collectionContentResultslist['collection']['last_modified']:"");
		$collection->setMoneyReleaseDate(isset($collectionContentResultslist['collection']['money_release_date'])?$collectionContentResultslist['collection']['money_release_date']:"");

		$collection->setCollectorId(isset($collectionContentResultslist['collection']['collector_id'])?$collectionContentResultslist['collection']['collector_id']:"");
		$collection->setExternalReference(isset($collectionContentResultslist['collection']['external_reference'])?$collectionContentResultslist['collection']['external_reference']:"");
		$collection->setReason(isset($collectionContentResultslist['collection']['reason'])?$collectionContentResultslist['collection']['reason']:"");
		$collection->setTransactionAmount(isset($collectionContentResultslist['collection']['transaction_amount'])?$collectionContentResultslist['collection']['transaction_amount']:"");
		$collection->setCurrencyId(isset($collectionContentResultslist['collection']['currency_id'])?$collectionContentResultslist['collection']['currency_id']:"");
		$collection->setShippingCost(isset($collectionContentResultslist['collection']['shipping_cost'])?$collectionContentResultslist['collection']['shipping_cost']:"");
		$collection->setNetReceivedAmount(isset($collectionContentResultslist['collection']['net_received_amount'])?$collectionContentResultslist['collection']['net_received_amount']:"");
		$collection->setStatus(isset($collectionContentResultslist['collection']['status'])?$collectionContentResultslist['collection']['status']:"");
		$collection->setStatusDetail(isset($collectionContentResultslist['collection']['status_detail'])?$collectionContentResultslist['collection']['status_detail']:"");
		$collection->setReleased(isset($collectionContentResultslist['collection']['released'])?$collectionContentResultslist['collection']['released']:"");
		$collection->setPaymentType(isset($collectionContentResultslist['collection']['payment_type'])?$collectionContentResultslist['collection']['payment_type']:"");
		$collection->setMarketplace(isset($collectionContentResultslist['collection']['marketplace'])?$collectionContentResultslist['collection']['marketplace']:"");
		$collection->setMercadopagoFee(isset($collectionContentResultslist['collection']['mercadopago_fee'])?$collectionContentResultslist['collection']['mercadopago_fee']:"");
		$collection->setOperationType(isset($collectionContentResultslist['collection']['operation_type'])?$collectionContentResultslist['collection']['operation_type']:"");
		$collection->setPayer($collectionPayer);
		
		$collectionList[$i] = $collection;
		unset($collection);
	
		}	
		return $collectionList;//returns a list of Collection Objects
        }
}
?>
