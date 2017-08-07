<?php
if(!class_exists("Gc_Message_Box_Addmetrixcode_Action")){
	class Gc_Message_Box_Addmetrixcode_Action extends Gc_MessageBox_Remote_Action_Setoption {
		public function __construct($namespace){
			$options = Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance()->get_namespace($namespace);
			parent::__construct("code",$options->get("metrix_code"));
		}
	}
}