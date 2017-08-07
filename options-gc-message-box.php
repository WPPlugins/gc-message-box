<?php
global $gc_message_box_options;
 $gc_message_box_options = array(
            'installed' => array(
                'id' => 'installed',
                'default' => "false",
                'text' => 'Plugin Installed',
                'type' => 'text',
                'group' => 'general',
                'visible' => false
            ),
            'enable_remote_configuration' => array(
                'id' => 'enable_remote_configuration',
                'default' =>2,
                'text' => 'Enable Remote Configuration:',
                'type' => 'onoff',
                'group' => 'internal_engine',
                'visible' => true,
                'description' => 'Enable connect to MY.GetConversion'
            ),
            'enable_remote_debug' => array(
                'id' => 'enable_remote_debug',
                'default' =>1,
                'text' => 'Enable Remote Debug:',
                'type' => 'onoff',
                'group' => 'internal_engine',
                'visible' => true,
                'description' => 'Enable remote debugging'
            ),            
            'metrix_code' => array(
                'id' => 'metrix_code',
                'default' =>"",
                'text' => 'Metrix Code:',
                'type' => 'text',
                'group' => 'internal_engine',
                'renderer' => 'Metrix_Code_Renderer',
                'visible' => true,
                'description' => 'Tracking code for MY.GetConversion (Format: XXXXXXX-X)'
            ),
            'cache_directory' => array(
                'id' => 'cache_directory',
                'default' => '',
                'text' => 'CSS Cache Directory:',
                'type' => 'number',
                'group' => 'internal_engine',
                'visible' => true,
                'description' => 'The style cache path directory of the GC Message Box<br/>Default value: {plugin dir}/cache - Otherwise: {WP install path (ABSPATH)}/&lt;the_value&gt;'
            ),            
			'force_php' => array(
				'id' => 'force_php',
				'default' => '2',
				'text' => 'Force PHP Filter:',
				'type' => 'onoff',
				'group' => 'internal_engine',
				'description' => 'Security option to prevent rendering out of the content'
			),
			'maximum_number' => array(
				'id' => 'maximum_number',
				'default' => '20',
				'text' => 'Maximum Number Of Boxes:',
				'description' => 'Maximum number of boxes on a page',
				'type' => 'number',
				'group' => 'internal_engine'
			),

            /* 
             * GENERAL SETTINGS
             */
			'box_enable' => array(
                'id' => 'box_enable',
                'default' =>'1',
                'text' => 'Enable GC Message Box:',
                'type' => 'onoff',
                'group' => 'general'
            ),'enable_adminbar' => array(
				'id' => 'enable_adminbar',
				'default' => '1',
				'text' => 'Enable WP Admin Bar Navigation:',
				'type' => 'onoff',
				'group' => 'general'
			),
            'css_handling' => array(
                'id' => 'css_handling',
                'default' =>'1',
                'text' => 'CSS Caching:',
                'type' => 'select',
                'options' => array(
                    '1' => 'Dynamic (Slowest)',
                    '2' => 'Cached (Fastest)',
                    '3' => 'Inline'
                ),
                'group' => 'general',
                'description' => "Select the caching method of the plugin's CSS<br/>DYNAMIC = No cache - INLINE = CSS generated in to HTML - CACHED = Generated static CSS"
            ),            
            'content_layout' => array(
                'id' => 'content_layout',
                'default' =>'1',
                'text' => 'Content Layout:',
                'type' => 'select',
                'options' => array(
                    '1' => 'Centred content - under centered button',
                    '2' => 'Left aligned content - under left aligned button',
                    '3' => 'Right aligned content - under right aligned button',
                    '4' => 'Left aligned button and left aligned content',
                    '5' => 'Right aligned content and right aligned button',
                    '6' => 'Left aligned button and right aligned content',
                    '7' => 'Left aligned content and right aligned button',
                    '8' => 'Center aligned button and content',
                    '9' => 'Center aligned content and button',
                ),
                'group' => 'general',
                'description' => 'Text content and button positions'
            ),
            'first_appear' => array(
                'id' => 'first_appear',
                'default' =>'1',
                'text' => 'First Appear After This Position:',
                'type' => 'number',
                'group' => 'general',
                'description' => 'The Message Box will appear after this post on list type screens<br/>(Eg: category)'
            ),
            'enable_repeat' => array(
                'id' => 'enable_repeat',
                'default' =>'1',
                'text' => 'Enable Repeat:',
                'type' => 'onoff',
                'group' => 'general',
                'description' => 'The Message Box will appear after first position repeatedly'
            ),
            'repeat_after' => array(
                'id' => 'repeat_after',
                'default' =>'3',
                'text' => 'Repeat After:',
                'type' => 'number',
                'group' => 'general_repeat',
                'description' => 'Count after first position'

            ),
            'margin_top_list' => array(
                'id' => 'margin_top_list',
                'default' =>'0',
                'text' => 'Margin Top on List Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'margin_right_list' => array(
                'id' => 'margin_right_list',
                'default' =>'0',
                'text' => 'Margin Right on List Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'margin_bottom_list' => array(
                'id' => 'margin_bottom_list',
                'default' =>'20',
                'text' => 'Margin Bottom on List Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'margin_left_list' => array(
                'id' => 'margin_left_list',
                'default' =>'0',
                'text' => 'Margin Left on List Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'margin_top_page' => array(
                'id' => 'margin_top_page',
                'default' =>'0',
                'text' => 'Margin Top on Article Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'margin_right_page' => array(
                'id' => 'margin_right_page',
                'default' =>'0',
                'text' => 'Margin Right on Article Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'margin_bottom_page' => array(
                'id' => 'margin_bottom_page',
                'default' =>'20',
                'text' => 'Margin Bottom on Article Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'margin_left_page' => array(
                'id' => 'margin_left_page',
                'default' =>'0',
                'text' => 'Margin Left on Article Screens:',
                'type' => 'number',
                'group' => 'general'
            ),
            'enable_animation' => array(
                'id' => 'enable_animation',
                'default' => '2',
                'text' => 'Enable Animation:',
                'type' => 'onoff',
                'group' => 'general'
            ),
            'enable_closing' => array(
                'id' => 'enable_closing',
                'default' => '2',
                'text' => 'Enable Close Button:',
                'type' => 'onoff',
                'group' => 'general'
            ),
            'state_cookie_time' => array(
                'id' => 'state_cookie_time',
                'default' => '24', 
                'text' => 'State Cookie Time (hours):',
                'type' => 'number',
                'group' => 'general_close',
                'description' => 'This time long will remember if it was previoulsy closed or opened. Type 0 to disable cookies'
            ),
			'enable_shortcode' => array(
				'id' => 'enable_shortcode',
				'default' => '2',
				'text' => 'Enable Shortcodes:',
				'type' => 'onoff',
				'group' => 'general',
				'description' => 'It enables the built-in Wordpress shortcode renderer (forexample [caption]My Caption[/caption])'
			),
            'enable_cloaking' => array(
                'id' => 'enable_cloaking',
                'default' => '2',
                'text' => 'Enable Link Cloaking:',
                'type' => 'onoff',
                'group' => 'general'
            ),
            

            /* 
             * COMPOSE MESSAGE
             */
            'action_url' => array(
                'id' => 'action_url',
                'default' =>'http://wordpress.org/extend/plugins/gc-message-box/',
                'text' => 'Action URL',
                'type' => 'text',
                'group' => 'compose',
                'description' => 'Use absolute or relative path'
                ),
            'action_target' => array(
                'id' => 'action_target',
                'default' =>'1',
                'text' => 'Open In New window',
                'type' => 'checkbox',
                'group' => 'compose'
                ),
            'action_nofollow' => array(
                'id' => 'action_nofollow',
                'default' =>'1',
                'text' => 'No Follow',
                'type' => 'checkbox',
                'group' => 'compose'
                ),
            'action_button_text' => array(
                'id' => 'action_button_text',
                'default' =>'Download',
                'formatting' => true,
                'text' => 'Action Button Text',
                'type' => 'text',
                'group' => 'compose',
                'description' => 'Recommended max length: 24 characters',
                'remote_edit_enable' => true
                ),
            'message_text' => array(
                'id' => 'message_text',
                'default' =>'Get an awesome embedded message box!',
                'formatting' => true,
                'text' => 'Message Text',
                'type' => 'textarea',
                'group' => 'compose',
                'description' => 'Recommended max length: 78 characters',
                'remote_edit_enable' => true
            ),
            /* 
             * FILTERS
             */
            'appear_here' => array(
                'id' => 'appear_here',
                'default' =>'1',
                'text' => 'Display Filter:',
                'type' => 'select',
                'options' => array(
                    '1' => 'Not filtered',
                    '2' => 'Just on selected screens',
                    'displayed_pages_allow' => 'Allow on specified pages',
                    'displayed_pages_deny' => 'Deny on specified pages'
                ),
                'group' => 'filters'
            ),
            'appear_here_home' => array(
                'id' => 'appear_here_home',
                'default' =>'1',
                'text' => 'Home:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'appear_here_category' => array(
                'id' => 'appear_here_category',
                'default' =>'1',
                'text' => 'Categories:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'appear_here_tag' => array(
                'id' => 'appear_here_tag',
                'default' =>'1',
                'text' => 'Tags:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'appear_here_archive' => array(
                'id' => 'appear_here_archive',
                'default' =>'1',
                'text' => 'Archives:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'appear_here_author' => array(
                'id' => 'appear_here_author',
                'default' =>'1',
                'text' => 'Authors:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'appear_here_search' => array(
                'id' => 'appear_here_search',
                'default' =>'1',
                'text' => 'Search results:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'appear_here_pages' => array(
                'id' => 'appear_here_pages',
                'default' =>'2',
                'text' => 'Pages:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'appear_here_article' => array(
                'id' => 'appear_here_article',
                'default' =>'1',
                'text' => 'Article screens:',
                'type' => 'checkbox',
                'group' => 'filters_appear_here'
            ),
            'displayed_pages' => array(
                'id' => 'displayed_pages',
                'default' => '',
                'text' => 'Add Page:',
                'type' => 'text',
                'group' => 'filters_appear_here',
                'renderer' => 'Ajax_Group_Renderer',
                'description' => 'Use the full URL of the page'
            ),
            'device_filter' => array(
                'id' => 'device_filter',
                'default' => '2',
                'text' => 'Device Filter:',
                'type' => 'select',
                'group' => 'filters',
                'description' => 'Filter for devices (Desktop / Mobile)',
                'options' => array(
                    '2' => 'Appears on Desktop and Mobile',
                    '1' => 'Appears on Desktop Only',
                    '3' => 'Appears on Mobile Only'
                )
            ),            
            'auth_filter' => array(
                'id' => 'auth_filter',
                'default' => '1',
                'text' => 'Authentication Filter:',
                'type' => 'select',
                'options' => array(
                    '1' => 'Not filtered',
                    '2' => 'Only Logged In',
                    '3' => 'Only Logged Out'
                ),
                'group' => 'filters'
            ),
            'role_filter' => array(
                'id' => 'role_filter',
                'default' => '2',
                'text' => 'User Role Filter:',
                'type' => 'onoff',
                'renderer' => 'RoleFilter_Renderer',
                'group' => 'filters',
                'description' => 'Administrator Role can not be disabled'
            ),
            'role_filter_list' => array(
                'id' => 'role_filter_list',
                'default' => serialize(array()),
                'renderer' => 'RoleFilter_Group_Renderer',
                'group' => 'filters_role_filter'
            ),
            'groups' => array(
                'id' => 'groups',
                'default' => '2',
                'text' => 'User Group Filter:',
                'type' => 'onoff',
                'renderer' => 'GroupFilter_Renderer',
                'group' => 'filters',
                'description' => 'Required Groups and Groups for WooCommerce plugins'
            ),
            'group_filter_list' => array(
                'id' => 'group_filter_list',
                'default' => serialize(array()),
                'renderer' => 'GroupFilter_Group_Renderer',
                'group' => 'filters_groups'
            ),


            /* 
             * STYLE SETTINGS
             */
            'theme_selector' => array(
                'id' => 'theme_selector',
                'type' => 'select',
                'group' => 'style',
                'description' => 'Recommended max length: 78 characters',
                'storable' => false,
                'renderer' => 'Themeselect_Renderer'
                ),
            'message_font' => array(
                'id' => 'message_font',
                'default' => 'inherit',
                'text' => 'Font type for message:',
                'type' => 'select',
                'options' => array(
                    'inherit' => 'Default body font',
                    'Arial, Helvetica, sans-serif' => 'Arial, Arial, Helvetica',
                    'Arial Black, Gadget, sans-serif' => 'Arial Black, Arial Black, Gadget',
                    'Comic Sans MS, cursive' => 'Comic Sans MS',
                    'Courier New, monospace' => 'Courier New',
                    'Georgia, serif' => 'Georgia',
                    'Impact, Charcoal, sans-serif' => 'Impact, Charcoal',
                    'Lucida Console, Monaco, monospace' => 'Lucida Console, Monaco',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif' => 'Lucida Sans Unicode, Lucida Grande',
                    'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino',
                    'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva',
                    'Times New Roman, Times, serif' => 'Times New Roman, Times',
                    'Trebuchet MS, sans-serif' => 'Trebuchet MS',
                    'Verdana, Geneva, sans-serif' => 'Verdana, Geneva',
                    'Open Sans, sans-serif' => 'Open Sans',
                    'Oswald, sans-serif' => 'Oswald',
                    'Droid Sans, sans-serif' => 'Droid Sans',
                    'Open Sans Condensed, sans-serif' => 'Open Sans Condensed',
                    'Lato, sans-serif' => 'Lato',
                    'PT Sans, sans-serif' => 'PT Sans',
                    'Droid Serif, serif' => 'Droid Serif',
                    'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz',
                    'Roboto, sans-serif' => 'Roboto',
                    'Bitter, serif' => 'Bitter'
                ),
                'renderer' => "Fonttype_Select_Renderer",
                'group' => 'style'
            ),
            'message_font_size' => array(
                'id' => 'message_font_size',
                'default' => 'inherit',
                'text' => 'Font size for message:',
                'type' => 'select',
                'options' => array(
                    'inherit' => 'Default body font size',
                    '8px' => '8 pixels',
                    '9px' => '9 pixels',
                    '10px' => '10 pixels',
                    '11px' => '11 pixels',
                    '12px' => '12 pixels',
                    '13px' => '13 pixels',
                    '14px' => '14 pixels',
                    '15px' => '15 pixels',
                    '16px' => '16 pixels',
                    '17px' => '17 pixels',
                    '18px' => '18 pixels',
                    '19px' => '19 pixels',
                    '20px' => '20 pixels'
                ),
                'group' => 'style'
            ),
            'action_button_font' => array(
                'id' => 'action_button_font',
                'default' => 'inherit',
                'text' => 'Font type for action button text:',
                'type' => 'select',
                'options' => array(
                    'inherit' => 'Default body font',
                    'Arial, Helvetica, sans-serif' => 'Arial, Arial, Helvetica',
                    'Arial Black, Gadget, sans-serif' => 'Arial Black, Arial Black, Gadget',
                    'Comic Sans MS, cursive' => 'Comic Sans MS',
                    'Courier New, monospace' => 'Courier New',
                    'Georgia, serif' => 'Georgia',
                    'Impact, Charcoal, sans-serif' => 'Impact, Charcoal',
                    'Lucida Console, Monaco, monospace' => 'Lucida Console, Monaco',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif' => 'Lucida Sans Unicode, Lucida Grande',
                    'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino',
                    'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva',
                    'Times New Roman, Times, serif' => 'Times New Roman, Times',
                    'Trebuchet MS, sans-serif' => 'Trebuchet MS',
                    'Verdana, Geneva, sans-serif' => 'Verdana, Geneva',
                    'Open Sans, sans-serif' => 'Open Sans',
                    'Oswald, sans-serif' => 'Oswald',
                    'Droid Sans, sans-serif' => 'Droid Sans',
                    'Open Sans Condensed, sans-serif' => 'Open Sans Condensed',
                    'Lato, sans-serif' => 'Lato',
                    'PT Sans, sans-serif' => 'PT Sans',
                    'Droid Serif, serif' => 'Droid Serif',
                    'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz',
                    'Roboto, sans-serif' => 'Roboto',
                    'Bitter, serif' => 'Bitter'
                ),
                'renderer' => "Fonttype_Select_Renderer",
                'group' => 'style'
            ),
            'action_button_font_size' => array(
                'id' => 'action_button_font_size',
                'default' => 'inherit',
                'text' => 'Font size for action button text:',
                'type' => 'select',
                'options' => array(
                    'inherit' => 'Default body font size',
                    '8px' => '8 pixels',
                    '9px' => '9 pixels',
                    '10px' => '10 pixels',
                    '11px' => '11 pixels',
                    '12px' => '12 pixels',
                    '13px' => '13 pixels',
                    '14px' => '14 pixels',
                    '15px' => '15 pixels',
                    '16px' => '16 pixels',
                    '17px' => '17 pixels',
                    '18px' => '18 pixels',
                    '19px' => '19 pixels',
                    '20px' => '20 pixels'
                ),
                'group' => 'style'
            ),

            'background_color' => array(
                'id' => 'background_color',
                'default' =>'#0074a4',
                'text' => 'Background Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'background_color2' => array(
                'id' => 'background_color2',
                'default' =>'#008dbe',
                'text' => 'Background Color 2 (gradient):',
                'type' => 'color',
                'group' => 'style'
            ),
            'message_color' => array(
                'id' => 'message_color',
                'default' =>'#ffffff',
                'text' => 'Message Text Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_color' => array(
                'id' => 'action_button_color',
                'default' =>'#50aa38',
                'text' => 'Action Button Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_color2' => array(
                'id' => 'action_button_color2',
                'default' =>'#50aa38',
                'text' => 'Action Button Color 2 (gradient):',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_border_color' => array(
                'id' => 'action_button_border_color',
                'default' =>'#6cc552',
                'text' => 'Action Button Border Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_text_color' => array(
                'id' => 'action_button_text_color',
                'default' =>'#ffffff',
                'text' => 'Action Button Text Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_hover' => array(
                'id' => 'action_button_hover',
                'default' =>'#36921f',
                'text' => 'Action Button Hover Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_hover2' => array(
                'id' => 'action_button_hover2',
                'default' =>'#36921f',
                'text' => 'Action Button Hover Color 2 (gradient):',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_hover_border_color' => array(
                'id' => 'action_button_hover_border_color',
                'default' =>'#59b340',
                'text' => 'Action Button Hover Border Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'action_button_hover_text_color' => array(
                'id' => 'action_button_hover_text_color',
                'default' =>'#ffffff',
                'text' => 'Action Button Hover Text Color:',
                'type' => 'color',
                'group' => 'style'
            ),
            'text_shadow' => array(
                'id' => 'text_shadow',
                'default' =>'1',
                'text' => 'Text Shadow:',
                'type' => 'onoff',
                'group' => 'style',
            ),
            'message_shadow' => array(
                'id' => 'message_shadow',
                'default' =>'2',
                'text' => 'Message Text Shadow:',
                'type' => 'darklight',
                'options' => array(
                    "1" => 'light',
                    "2" => 'dark',
                ),                
                'group' => 'styling_shadow'
            ),
            'button_shadow' => array(
                'id' => 'button_shadow',
                'default' =>'2',
                'text' => 'Action Button Shadow:',
                'type' => 'darklight',
                'options' => array(
                    "1" => 'light',
                    "2" => 'dark',
                ),
                'group' => 'styling_shadow'
            ),
            'button_hover_shadow' => array(
                'id' => 'button_hover_shadow',
                'default' =>'2',
                'text' => 'Action Button Hover Shadow:',
                'type' => 'darklight',
                'options' => array(
                    "1" => 'light',
                    "2" => 'dark',
                ),                
                'group' => 'styling_shadow'
            ),
            'action_button_corner_radius' => array(
                'id' => 'action_button_corner_radius',
                'default' =>'3',
                'text' => 'Action Button Corner Radius:',
                'type' => 'number',
                'group' => 'style'
            ),
            'box_corner_radius' => array(
                'id' => 'box_corner_radius',
                'default' =>'3',
                'text' => 'Box Corner Radius:',
                'type' => 'number',
                'group' => 'style'
            ),
            'close_icon_color' => array(
                'id' => 'close_icon_color',
                'default' =>'1', 
                'text' => 'Close Icon Color:',
                'type' => 'darklight',
                'options' => array(
                    '1' => 'light',
                    '2' => 'dark'
                ),
                'group' => 'style'
            ),
            'box_shadow' => array(
                'id' => 'box_shadow',
                'default' =>'2',
                'text' => 'Message Box Shadow:',
                'type' => 'onoff',
                'group' => 'style'
            )
        );