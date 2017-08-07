<?php
if(!defined('GC_MESSAGE_BOX_LIB_PATH')){
	define('GC_MESSAGE_BOX_LIB_PATH','vendor'.DIRECTORY_SEPARATOR.'gc-message-box'.DIRECTORY_SEPARATOR);	
	define('GC_MESSAGE_BOX_ABS_LIB_PATH',plugin_dir_path( __FILE__ ) . GC_MESSAGE_BOX_LIB_PATH);
}
if(!defined('GC_MESSAGE_BOX_NAME')){
	define('GC_MESSAGE_BOX_NAME','gc_message_box');
	define('GC_MESSAGE_BOX_TYPE','gc-message-box');
	define('GC_MESSAGE_BOX_NS', 'gc_message_box_');	

	define('GC_MESSAGE_BOX_SL_CONFIG', 'config');
	define('GC_MESSAGE_BOX_SL_OPTION_REPOSITORY', 'option_repository');
	define('GC_MESSAGE_BOX_SL_OPTION_STORE', 'option_store');
	define('GC_MESSAGE_BOX_SL_SETTING_STORE', 'setting_store');
	define('GC_MESSAGE_BOX_SL_EVENT_MANAGER', 'event_manager');

}
