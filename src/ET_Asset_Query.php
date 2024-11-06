<?php
// spl_autoload_register( function($class_name) {
//     include_once 'src/'.$class_name.'.php';
// });
namespace FuelSdk;

/**
 *	An asset is an instance of any kind of content in the CMS.
 */
class ET_Asset_Query extends ET_CUDSupportRest
{
    /**
    * The constructor will assign endpoint, urlProps, urlPropsRequired fields of parent ET_BaseObjectRest
    */
	function __construct()
	{
		$this->path = "asset/v1/content/assets/query";
		$this->urlProps = [];
		$this->urlPropsRequired = [];
	}
}
?>
