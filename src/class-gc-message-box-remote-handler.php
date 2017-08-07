<?php
if(!class_exists("Gc_Message_Box_Remote_Handler")){
	class Gc_Message_Box_Remote_Handler extends Gc_MessageBox_Remote_Handler{
		protected $_namespace;
		public function __construct($namespace){
			parent::__construct();
			$this->_namespace = $namespace;
			$this->add_handler("add_metrix_code",new Gc_Message_Box_Addmetrixcode_Action($namespace));
		}
	}
}
