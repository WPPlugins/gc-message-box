<?php
if(interface_exists("Gc_MessageBox_Controller_Interface")){
    return;
}

interface Gc_MessageBox_Controller_Interface{
    function initialize();
    function initialize_hooks();
    function handle_request();
    function render();
}
