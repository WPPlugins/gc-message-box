<?php
require_once( plugin_dir_path( __FILE__ ) . 'options-gc-message-box.php');
require_once( plugin_dir_path( __FILE__ ) . 'themes-gc-message-box.php');
$gc_message_box_namespace = "gc_message_box_";
$repository = Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance();
$repository->add_namespace($gc_message_box_namespace);
$repository->add_configuration($gc_message_box_namespace,$gc_message_box_options);

$themeRepository = Gc_MessageBox_CF::create("Theme_Repository_Factory")->get_instance();
$themeRepository->init_themes($gc_message_box_themes);
