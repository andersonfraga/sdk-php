<?php
header("Content-Type: text/HTML");
//services require
require_once "../../../src/services/collectionService.php";
require_once "../../../src/services/authService.php";
//this archive contains client credentials
require_once "../../../src/config.php";
//classes required
require_once "../../../src/classes/collection.php";
require_once "../../../src/classes/collectionPayer.php";
require_once "../../../src/classes/collectionPayerPhone.php";

//Init
//The next lines are necesary to call the sevice
//array needed to call the service
$filters = array ("site_id" => $_GET['site_id'],
		  "external_reference" => $_GET['external_reference'],
		  "id" => $_GET['collection_id'],
 		  "offset" => $_GET['offset'],
		  "limit" => $_GET['limit']
		);

try{	
	
	$collectionService = new CollectionService(); //new Collection instance
	$collectionList=$collectionService->search_collection($filters,$_GET['access_token']);
	unset($collectionService);//free instance
	unset($accessData);//free instance

	if(gettype($collectionList)=='string')
		{
		throw new exception($collectionList);//throw exception
		}
	//////////////////////////////////////////////////////////////////////////
	//The next lines are just the rendering of the example data, we show you the interaction with the API result about the example!

	?>
	<!doctype html>
	<!--[if IE]><![endif]-->
	<!--[if lt IE 7 ]> <html lang="es" class="no-js ie6"> <![endif]--> 
	<!--[if IE 7 ]>    <html lang="es" class="no-js ie7"> <![endif]-->
	<!--[if IE 8 ]>    <html lang="es" class="no-js ie8"> <![endif]--> 
	<!--[if IE 9 ]>    <html lang="es" class="no-js ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
	</head>

	<body>
		<span><b><?//="Collections total=".sizeof($collectionList)." limit=".$_GET['limit']." offset=".$_GET['offset'];?></b></span>
		<table id="asadf" class="datagrid" border="1">
			<thead>
				<th>mp collection id</th>
				<th>reason</th>
				<th>transaction amount</th>
				<th>status</th>
				<th>status detail</th>
				<th>payer email</th>
				<th>external reference</th>
				<th>actions</th>
			</thead>
			<tbody>


					<?
					for ($val = 0; $val < sizeof($collectionList); $val++) {
						?>
				                        <tr>
				                                <td><?echo $collectionList[$val]->getId();?></td>
				                                <td><?echo $collectionList[$val]->getReason();?></td>
				                                <td><?echo $collectionList[$val]->getTransactionAmount();?></td>
				                                <td><?echo $collectionList[$val]->getStatus();?></td>
				                                <td><?echo $collectionList[$val]->getStatusDetail();?></td>
				                                <td><?echo $collectionList[$val]->getPayer()->getEmail();?></td>
								<td><?echo $collectionList[$val]->getExternalReference();?></td>
								<td></td>
				                                <!--<td><a href="getCollectionController.php?collection_id=<?echo $collectionList[$val]->getId();?>" id="get" name="get" value="Get">show details</a></td>-->
				                        </tr>
					        <?
					}

					?>

			</tbody>
		</table>

	</body>
	</html>
<?
unset($collection); //free instance
}
/////////////////////////////////////
//The next lines handles the exception
catch (Exception $e) {//catch exception
 	echo $e->getMessage();
}


