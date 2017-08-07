<?php
if(interface_exists('Gc_MessageBox_Serializable_Interface')) {
    return;
}

interface Gc_MessageBox_Serializable_Interface{
    function load_from_array($parameters);
    function export_to_array();
    function export_data_to_array();

}


