<?php
// spl_autoload_register( function($class_name) {
//     include_once 'src/'.$class_name.'.php';
// });
namespace FuelSdk;

/**
* Defines a triggered send in the account.
*/
class ET_Query extends ET_CUDSupport
{
	/**
	* @var array    		Gets or sets the subscribers. e.g. array("EmailAddress" => "", "SubscriberKey" => "")
	*/
	public  $subscribers;

	/**
	* @var int      		Gets or sets the folder identifier.
	*/
	public $folderId;
	/** 
	* Initializes a new instance of the class.
	*/
	function __construct()
	{
		$this->obj = "QueryDefinition";
	}

	public function perform(){
		$originalProps = $this->props;		
		$response = new ET_Perform($this->authStub, $this->obj, 'start', $this->props);
		if ($response->status) {
			$this->lastTaskID = $response->results[0]->Task->ID;
		}
		$this->props = $originalProps;
		return $response;
	}

	function status($taskID)
	{
		$this->filter = array('Property' => 'TaskID','SimpleOperator' => 'equals','Value' => $taskID);
		$response = new ET_Get($this->authStub, 'AsyncActivityStatus', array('Status', 'StatusMessage', 'ErrorMsg'), $this->filter);
		$this->lastRequestID = $response->request_id;
		return $response;
	}


}
?>