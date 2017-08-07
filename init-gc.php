<?php
require_once(GC_MESSAGE_BOX_ABS_LIB_PATH."init.php");
Gc_MessageBox_CF::set_prefix("Gc_MessageBox");

global $GC_Message_Box_Config;
Gc_MessageBox_Service_Locator::set(GC_MESSAGE_BOX_SL_CONFIG,$GC_Message_Box_Config);
global $GC_Mygetconversion_Worker;
if(!isset($GC_Mygetconversion_Worker)){
	$GC_Mygetconversion_Worker = array("run" => 0,"plugins" => array());
}
$GC_Mygetconversion_Worker["plugins"][GC_MESSAGE_BOX_TYPE] = true;
$event_manager = Gc_MessageBox_CF::create_and_init("Event_Manager",array("global" => true, "namespace"=> "get_conversion"));
Gc_MessageBox_Service_Locator::set(GC_MESSAGE_BOX_SL_EVENT_MANAGER,$event_manager);

