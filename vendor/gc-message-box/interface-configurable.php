<?php
if(interface_exists('Gc_MessageBox_Configurable_Interface')) {
    return;
}

interface Gc_MessageBox_Configurable_Interface{
    function configure(array $options);

}


