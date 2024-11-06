<?php

namespace FuelSdk;
use \SoapVar;
/**
 * This class represents the POST operation for SOAP service.
 */
class ET_Schedule extends ET_Constructor
{
	/**
	* Initializes a new instance of the class.
	* @param 	ET_Client   $authStub 	The ET client object which performs the auth token, refresh token using clientID clientSecret
	* @param    string      $objType 	Object name, e.g. "ImportDefinition", "DataExtension", etc
	* @param 	array       $props 		Dictionary type array which may hold e.g. array('id' => '', 'key' => '')
	* @param 	bool 		$upsert 	If true SaveAction is UpdateAdd, otherwise not. By default false.
	*/
	function __construct($authStub, $objType, $props, $upsert = false)
	{	

		$partnerApiUrl = "http://exacttarget.com/wsdl/partnerAPI";
		$authStub->refreshToken();
		$schedule = array();
		$scheduleRequest = array();
		$etr = array(
			'DailyRecurrencePatternType' => 'Interval',
      		'DayInterval'                => 1
		);

		$def = array(
			'CustomerKey'      => $props['defintionId']
		);


		$scheduleRequest['Action'] = 'start';

		$scheduleRequest['Schedule'] = [
			'Recurrence'          => new SoapVar($etr, SOAP_ENC_OBJECT, 'DailyRecurrence', $partnerApiUrl),
			'RecurrenceType'      => 'Daily',
			'RecurrenceRangeType' => 'EndAfter',
			'StartDateTime'       => $props['scheduleDate'],
			'Occurrences'         => 1
		];


		$scheduleRequest['Interactions'] = [
			'Interaction'      => new SoapVar($def, SOAP_ENC_OBJECT, 'EmailSendDefinition', $partnerApiUrl),
		];

		$scheduleRequest['Options'] = NULL;


		$schedule['ScheduleRequestMsg'] = $scheduleRequest;
		$return = $authStub->__soapCall("Schedule", $schedule, null, null , $out_header);
		parent::__construct($return, $authStub->__getLastResponseHTTPCode());		
		
		if ($this->status){
			if (property_exists($return, "Results")){
				// We always want the results property when doing a retrieve to be an array
				if (is_array($return->Results)){
					$this->results = $return->Results;
				} else {
					$this->results = array($return->Results);
				}
			} else {
				$this->status = false;
				
			}
			if ($return->OverallStatus != "OK")
			{
				$this->status = false;
			}
		}			
	}
}
?>