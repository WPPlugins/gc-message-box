<?php
if(class_exists("Gc_MessageBox_Remote_Action_Empty")){
    return;
}

class Gc_MessageBox_Remote_Action_Empty implements Gc_MessageBox_Remote_Action_Interface {
    public function execute($request){
        return array("error" => true,"msg" => "cmd not found", "code" => 101);
    }
}