<?php
if(interface_exists('Gc_MessageBox_Storable_Interface')) {
    return;
}

interface Gc_MessageBox_Storable_Interface{
    function save();
    function load();
    function set_store_engine($engine);
    function get_store_engine();
    function get_store_engine_instance();

}


