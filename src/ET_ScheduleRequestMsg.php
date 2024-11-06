<?php

namespace FuelSdk;


class ET_ScheduleRequestMsg extends ET_CUDSupport
{
	function __construct()
	{
		$this->obj = "ScheduleRequestMsg";
	}

	function schedule()
	{
		$originalProps = $this->props;

		$response = new ET_Schedule($this->authStub, $this->obj, $this->props);
		$this->props = $originalProps;
		
		return $response;
	}
}
?>