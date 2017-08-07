<?php
/*
Plugin Name: GC Message Box
Version: 2.3.9
Plugin URI: http://wordpress.org/plugins/gc-message-box
Description: GC Message Box is an easy to use plugin that allows you to increase conversion rates by adding a Call To Action button within articles and blog posts
Author: GetConversion
Author URI: http://getconversion.com
License: GPL2
*/

/*  Copyright 2014 eRise Hungary Ltd.  (email : info@getconversion.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



require_once( plugin_dir_path( __FILE__ ) . 'default.php');
require_once( plugin_dir_path( __FILE__ ) . 'init-constants.php');
require_once( plugin_dir_path( __FILE__ ) . 'init-gc.php');
require_once( plugin_dir_path( __FILE__ ) . 'init-options.php');
require_once( plugin_dir_path( __FILE__ ) . 'admin-layout-gc-message-box.php');
require_once( plugin_dir_path( __FILE__ ) . 'init-message-box.php');
Gc_MessageBox_Util::initialize(__FILE__,GC_MESSAGE_BOX_NAME,GC_MESSAGE_BOX_TYPE);

$p = new Gc_MessageBox_Plugin();
$p->add_admin_controller(new Gc_Message_Box_Admin_Controller(GC_MESSAGE_BOX_NS))
       ->add_controller(new Gc_Message_Box_Controller(GC_MESSAGE_BOX_NS))
       ->run();

if(!function_exists("gc_message_box_show()")){
    function gc_message_box_show(){
        if($_COOKIE[GC_MESSAGE_BOX_NS . 'cookie'] == 'closed') {
            return;
        }
        
        $controller = new Gc_Message_Box_Controller(GC_MESSAGE_BOX_NS);
        $controller->initialize();
        $controller->render_with_random_id();
    }    
}
