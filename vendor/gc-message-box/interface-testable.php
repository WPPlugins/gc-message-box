<?php
if(interface_exists('Gc_MessageBox_Testable_Interface')) {
    return;
}

interface Gc_MessageBox_Testable_Interface{
    function set_variant($variant);
    function get_variant();
    function count_actual_variant();
    function is_under_testing();
    function get_control_value();
    function get_variant_value($variant);
}


