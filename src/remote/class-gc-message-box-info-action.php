<?php
if(class_exists("Gc_Message_Box_Info_Action")){
	return;
}
class Gc_Message_Box_Info_Action implements Gc_MessageBox_Remote_Action_Interface {
	public function __construct($namespace){
	}
	public function execute($request){ 
		return array("success" => true,"ver" => Gc_MessageBox_Util::get_version());
	}
}


