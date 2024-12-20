<?php
// spl_autoload_register( function($class_name) {
//     include_once 'src/'.$class_name.'.php';
// });
namespace FuelSdk;

/**
* ET_Email - Represents an email in a Marketing Cloud account.
*/
class ET_Publication extends ET_CUDSupport
{
	/**
	* @var int 	Gets or sets the folder identifier.
	*/
	public  $folderId;

    /**
    * Initializes a new instance of the class and will assign obj, folderProperty, folderMediaType property 
    */ 	
	function __construct()
	{
		$this->obj = "Publication";
		//$this->folderProperty = "CategoryID";
		//$this->folderMediaType = "email";
	}
}
?>