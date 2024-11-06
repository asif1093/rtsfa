<?php
// spl_autoload_register( function($class_name) {
//     include_once 'src/'.$class_name.'.php';
// });
namespace FuelSdk;

/**
* Represents a program in an account
*/
class ET_Event extends ET_CUDSupportRest
{
    /**
    * Initializes a new instance of the class and will assign endpoint, urlProps, urlPropsRequired fields of parent ET_BaseObjectRest
    */
	function __construct()
	{
		$this->path = "/interaction/v1/events";
		$this->urlProps = array();
		$this->urlPropsRequired = array();
	}
}
?>
