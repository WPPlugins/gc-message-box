<?php
if(interface_exists('Gc_MessageBox_Option_Meta_Data_Interface')) {
    return;
}

interface Gc_MessageBox_Option_Meta_Data_Interface{
    function is_visible();
    function set_visible($visible);
    function is_remote_edit_enable();
    function set_remote_edit_enable($enable);
    function set_instance($id);
    function get_instance();

}
