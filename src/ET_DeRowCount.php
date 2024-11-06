<?php
// spl_autoload_register( function($class_name) {
//     include_once 'src/'.$class_name.'.php';
// });
namespace FuelSdk;

/**
 *	An asset is an instance of any kind of content in the CMS.
 */
class ET_DeRowCount extends ET_CUDSupportRest
{
    /**
    * The constructor will assign endpoint, urlProps, urlPropsRequired fields of parent ET_BaseObjectRest
    */ 
	function __construct()
	{
		$this->path = "data/v1/customobjectdata/key/{de}/rowset";
		$this->urlProps = array("de");
		$this->urlPropsRequired = array();
	}

    

    /**
    * @return null
    */
	public function patch()
	{
		return null;
	}

    /**
    * @return null
    */
	public function delete()
	{
		return null;
	}
}
?>