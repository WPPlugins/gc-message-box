<?php
global $gc_message_box_admin_layout;
$gc_message_box_admin_layout = array(
	"general" => array(
		"title" => "General Settings",
		"id"    => "general_settings",
		"option_group" => "general",
		"sub_groups" => array(
			"enable_repeat" => array(
				"title" => "Repeat Settings",
				"id"    => "repeat_settings",
				"option_group" => "general_repeat",
				'params' => array(
					'css_class' => "before-itemgroup after-itemgroup"
				),
				'parent_option_state' => array(
                    "1" => "visible",
                    "2" => "hidden"
                )

			),
            "enable_closing" => array(
                "title" => "Close Settings",
                "id"    => "close_settings",
                "option_group" => "general_close",
                'params' => array(
                    'css_class' => "before-itemgroup after-itemgroup"
                ),
                'parent_option_state' => array(
                    "1" => "visible",
                    "2" => "hidden"
                )

            ),
        ),
    ),
    "filters" => array(
        "title" => "Filters",
        "id"    => "filters",
        "option_group" => "filters",
        "sub_groups" => array(
			"appear_here" => array(
				"title"	=> "Display Filter",
				"id"	=> "appear_here_settings",
				"option_group"	=> "filters_appear_here",
				'params'	=> array(
					'css_class' => "before-itemgroup after-itemgroup"
				),
				'parent_option_state'	=> array(
					"1" => "hidden",
					"2"	=> "2",
					"3"	=> "displayed_pages_allow",
					"4"	=> "displayed_pages_deny"
				),
				'options_visibility' => array(
                	"2" => array(
                		"appear_here_home" => "show",
                		"appear_here_category" => "show",
                		"appear_here_tag" => "show",
                		"appear_here_archive" => "show",
                		"appear_here_author" => "show",
                		"appear_here_search" => "show",
                		"appear_here_pages" => "show",
                		"appear_here_article" => "show",
						"displayed_pages" => "hidden"
                	),
                	"displayed_pages_allow" => array(
                		"appear_here_home" => "hidden",
                		"appear_here_category" => "hidden",
                		"appear_here_tag" => "hidden",
                		"appear_here_archive" => "hidden",
                		"appear_here_author" => "hidden",
                		"appear_here_search" => "hidden",
                		"appear_here_pages" => "hidden",
                		"appear_here_article" => "hidden",
                		"displayed_pages" => "show"
                	),
                	"displayed_pages_deny" => array(
                		"appear_here_home" => "hidden",
                		"appear_here_category" => "hidden",
                		"appear_here_tag" => "hidden",
                		"appear_here_archive" => "hidden",
                		"appear_here_author" => "hidden",
                		"appear_here_search" => "hidden",
                		"appear_here_pages" => "hidden",
                		"appear_here_article" => "hidden",
                		"displayed_pages" => "show"
                	)
                ),
            ),
            "role_filter" => array(
                "title" => "Enable For User Roles",
                "id"    => "enable_settings",
                "option_group" => "filters_role_filter",
                'params' => array(
                    'css_class' => "before-itemgroup after-itemgroup"
                ),
                'parent_option_state' => array(
                    "1" => "show",
                    "2" => "hidden"
                )
            ),
            "groups" => array(
                "title" => "Enable For User Groups",
                "id"    => "groups_settings",
                "option_group" => "filters_groups",
                'params' => array(
                    'css_class' => "before-itemgroup after-itemgroup"
                ),
                'parent_option_state' => array(
                    "1" => "show",
                    "2" => "hidden"
                )
            )
				
		)
	),
    "compose" => array(
        "title" => "Compose Message",
		"id"    => "compose_message",
		"option_group" => "compose",
		"renderer" => "Gc_Message_Box_Options_Compose_Container_Renderer"
    ),
	"style" => array(
		"title" => "Style Settings",
		"id"    => "style_settings",
		"option_group" => "style",
        "sub_groups" => array(
            "text_shadow" => array(
                "title" => "Text Shadow Settings",
                "id"    => "text_shadow_settings",
                "option_group" => "styling_shadow",
                'params' => array(
                    'css_class' => "before-itemgroup after-itemgroup"
                ),
                'parent_option_state' => array(
                    "1" => "visible",
                    "2" => "hidden"
                )
            )
        )
	)
);