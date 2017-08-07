<?php
    require('../../../wp-blog-header.php');
    @header("Content-type: text/css",true,200);
    require_once( plugin_dir_path( __FILE__ ) . 'init-options.php');
    Gc_MessageBox_CF::set_prefix("Gc_MessageBox");
    $renderer = new Gc_Message_Box_Style_Renderer(GC_MESSAGE_BOX_NS);
    $renderer->configure(array());
    $renderer->render(array("echo" => "true"));
