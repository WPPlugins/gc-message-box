<?php
if(interface_exists('Gc_MessageBox_Remote_Action_Output_Interface')) {
    return;
}

interface Gc_MessageBox_Remote_Action_Output_Interface{
    function format($data);
}