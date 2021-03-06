<?php
include_once('tests/UnitBootstrap.php');
use FuelSdk\ET_Client;
use FuelSdk\ET_ExtractDescription;


try {	
	$myclient = new ET_Client();

	// Modify the date below to reduce the number of results returned from the request
	// Setting this too far in the past could result in a very large response size
	
	$retrieveDate = "2017-01-15T13:00:00.000";
	
	// Retrieve Filtered OpenEvent with GetMoreResults
	print "Retrieve Filtered Extract Description with GetMoreResults \n";
	$getOpenEvent = new ET_ExtractDescription();
	$getOpenEvent->authStub = $myclient;
//	$getOpenEvent->props = array("SendID","SubscriberKey","EventDate","Client.ID","EventType","BatchID","TriggeredSendDefinitionObjectID","PartnerKey");
	$getOpenEvent->props = array("ID","CustomerKey","Name", "Description","InteractionObjectID", "ObjectID","PartnerKey","CreatedDate","Client.ID","EventType","BatchID","TriggeredSendDefinitionObjectID","PartnerKey");
//	$getOpenEvent->filter = array('Property' => 'EventDate','SimpleOperator' => 'greaterThan','DateValue' => $retrieveDate);
//	$getOpenEvent->getSinceLastBatch = false;
	$getResponse = $getOpenEvent->get();
	print_r('Get Status: '.($getResponse->status ? 'true' : 'false')."\n");
	print 'Code: '.$getResponse->code."\n";
	print 'Message: '.$getResponse->message."\n";
	print_r('More Results: '.($getResponse->moreResults ? 'true' : 'false')."\n");
	print 'Results Length: '. count($getResponse->results)."\n";
	print "\n---------------\n";
	print 'Results Length: '. count($getResponse->results)."\n";
	print "\n---------------\n";
	print 'Results : ';
    print_r( $getResponse->results );
	print "\n---------------\n";
	
	while ($getResponse->moreResults) {
		print "Continue Retrieve All OpenEvent with GetMoreResults \n";
		$getResponse = $getOpenEvent->GetMoreResults();
		print_r('Get Status: '.($getResponse->status ? 'true' : 'false')."\n");
		print 'Code: '.$getResponse->code."\n";
		print 'Message: '.$getResponse->message."\n";
		print_r('More Results: '.($getResponse->moreResults ? 'true' : 'false')."\n");
		print 'Results Length: '. count($getResponse->results)."\n";
		print "\n---------------\n";
	}

	
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>



