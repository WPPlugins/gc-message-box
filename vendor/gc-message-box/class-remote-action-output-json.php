<?php
if(class_exists("Gc_MessageBox_Remote_Action_Output_Json")){
    return;
}

class Gc_MessageBox_Remote_Action_Output_Json implements Gc_MessageBox_Remote_Action_Output_Interface{
    public function format($data){
        return json_encode($data);
    }
}