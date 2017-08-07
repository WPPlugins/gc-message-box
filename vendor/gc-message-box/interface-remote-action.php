<?php
if(interface_exists('Gc_MessageBox_Remote_Action_Interface')) {
    return;
}

interface Gc_MessageBox_Remote_Action_Interface{
    function execute($request);
}