<?php
// spl_autoload_register( function($class_name) {
//     include_once 'src/'.$class_name.'.php';
// });
namespace FuelSdk;
use \SoapVar;
/**
 * This class represents the POST operation for SOAP service.
 */
class ET_PostAsync extends ET_Constructor
{
	/**
	* Initializes a new instance of the class.
	* @param 	ET_Client   $authStub 	The ET client object which performs the auth token, refresh token using clientID clientSecret
	* @param    string      $objType 	Object name, e.g. "ImportDefinition", "DataExtension", etc
	* @param 	array       $props 		Dictionary type array which may hold e.g. array('id' => '', 'key' => '')
	* @param 	bool 		$upsert 	If true SaveAction is UpdateAdd, otherwise not. By default false.
	*/
	function __construct($authStub, $objType, $props, $options, $upsert = false)
	{
		$authStub->refreshToken();
		$cr = array();
		$objects = array();

		if (ET_Util::isAssoc($props)){
			$objects["Objects"] = new SoapVar($props, SOAP_ENC_OBJECT, $objType, "http://exacttarget.com/wsdl/partnerAPI");
		} else {
			$objects["Objects"] = array();
			foreach($props as $object){
				$objects["Objects"][] = new SoapVar($object, SOAP_ENC_OBJECT, $objType, "http://exacttarget.com/wsdl/partnerAPI");
			}
		}

		if ($upsert) {
			$objects["Options"] = array('SaveOptions' => array('SaveOption' => array('PropertyName' => '*', 'SaveAction' => 'UpdateAdd' )));
		} else {
			$objects["Options"] = "";
		}

        $objects["Options"] = $options;

		$cr["CreateRequest"] = $objects;
		$return = $authStub->__soapCall("Create", $cr, null, null , $out_header);
		parent::__construct($return, $authStub->__getLastResponseHTTPCode());

		if ($this->status){
            if (property_exists($return, "RequestID")){
                $this->request_id = $return->RequestID;
            }
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
