<?php
if(!class_exists("Gc_Message_Box_Renderer")){
    class Gc_Message_Box_Renderer extends Gc_MessageBox_Abstract_Renderer{
        protected $options;
        protected $gci = 0;
        protected $event_manager = null;
        const hour = 3600000;
        const EV_RENDER_INNER_CONTENT = ".render_box_inner_content";
        const EV_RENDER_METRIX_TRACKER_EVENT = ".render_box_metrix_tracker_event";

        public function __construct($namespace, $controller){
            parent::__construct($namespace,$controller);
            $options = Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance()->get_namespace($this->namespace);
            $this->options = $options;
            $this->controller = $controller;
            $this->metrix_code = $options->get("metrix_code");
            $this->metrix_enable = ($this->metrix_code->get_value() != "");
            $this->event_manager = Gc_MessageBox_Service_Locator::get(GC_MESSAGE_BOX_SL_EVENT_MANAGER);
            $this->initialize();

    	}
        public function initialize(){
            $this->event_manager->listen(GC_MESSAGE_BOX_NAME.self::EV_RENDER_INNER_CONTENT,array($this,"on_render_inner_content"));
            $this->event_manager->listen(GC_MESSAGE_BOX_NAME.self::EV_RENDER_METRIX_TRACKER_EVENT,array($this,"on_render_metrix_tracker_event"));

        }

    	public function render($gci,$random = false){

			if (!$this->is_box_enabled()) {
				return '';
			}
            if($random){
                $box_id= $random;
            }else{
                $box_id = $gci;
            }
            $this->gci = $box_id;
            if ($this->get_option_value('enable_closing') == '1') {
                $query = parse_url($this->get_current_url(), PHP_URL_QUERY);
                if (!isset($request["data"]["close_".$this->namespace])) {
                    if( $query ) {
                        $url = $this->get_current_url() . '&' . "close_".$this->namespace;
                    }
                    else {
                        $url = $this->get_current_url() . '?' . "close_".$this->namespace;
                    }
                } else {
                    $url = $this->get_current_url();
                }
            }
            $expires = ($this->get_option_value('state_cookie_time')) ? $this->get_option_value('state_cookie_time') : 0;
            echo "<div class=\"gc_message_box\" id='gci_".$box_id."' style='".(($this->get_option_value('enable_animation') == '1') ? 'display: none; ' : '').$this->get_style()."'>";

            if ($this->get_option_value('enable_closing') == '1') { 
                echo "<a id=\"gc_message_box_close_$box_id\" class=\"close_icon".(($this->get_option_value('close_icon_color') == '1') ? ' dark' : '')."\" href=\"".$url."\"></a>";
            }
            
            $event = new Gc_MessageBox_Event(array("options" => $this->options,"gci" => $this->gci));
            $this->event_manager->dispatch(GC_MESSAGE_BOX_NAME.self::EV_RENDER_INNER_CONTENT,$event).
            $inner_content = $event->get_result();

            echo (($this->get_option_value('enable_shortcode') == "1") ? do_shortcode($inner_content) : $inner_content).
            "</div>";


            echo "<script type='text/javascript'>";
            $event = new Gc_MessageBox_Event(array(
                "options" => $this->options,
                "metrix_enable" => $this->metrix_enable,
                "metrix_code" => $this->metrix_code,
                "gci" => $this->gci

                ));
            $this->event_manager->dispatch(GC_MESSAGE_BOX_NAME.self::EV_RENDER_METRIX_TRACKER_EVENT,$event);
            echo $event->get_result();
            if ($this->get_option_value('enable_animation') == '1' && $this->get_option_value('enable_closing') == '1') {
                echo "
                    jQuery('#gc_message_box_close_$box_id').click(function() {
                        jQuery('.gc_message_box').slideUp(500, function() {
                            jQuery('.gc_message_box').remove();
                            var date = new Date();
                            date.setTime(date.getTime() + ".self::hour * $expires.");

                            if ( wpCookies.get('".$this->namespace."'+'cookie') ) { 
                                wpCookies.set('".$this->namespace."'+'cookie', null, 0, '/') ;
                            }
                            wpCookies.set('".$this->namespace."'+'cookie', 'closed', date, '/');


                        });
                        return false;
                    });
                ";
            }
            echo  "</script>";

    	}
    public function on_render_metrix_tracker_event($event){
            if(!$this->metrix_enable){
                return;
            }
            $metrix_code = $event->get_param("metrix_code")->get_value();

            $box_id = $event->get_param("gci");
            if($this->get_option_value("action_target") == "1"){
                 $event->set_result("jQuery('#gc_message_box_button_a_$box_id').click(function(e){
                            MXTracker.trackClick('".$metrix_code."');
                    });
                    ");

            } else{
                $event->set_result("jQuery('#gc_message_box_button_a_$box_id').click(function(e){
                            MXTracker.trackHref(e.currentTarget.href,'".$metrix_code."');
                            e.preventDefault();
                            return false;
                    });
                    ");

            }

        }
		public function is_box_enabled() {
			return ($this->get_option_value('box_enable') == "1") or ($this->controller->is_debug_render());
		}

        protected function get_general_options(){
            return $this->options->filter_options_by_group("general");
        }

        protected function get_style_options(){
            return $this->options->filter_options_by_group("style");
        }


        public function on_render_inner_content($event) {
            $align = $this->get_option_value('content_layout');
            $align_renderer = new Gc_Message_Box_Align_Renderer($align, $this);
            $event->set_result($align_renderer->render());
        }
        
        protected function get_style() {
            $style = "";
            //Margins
            if ($this->controller->is_list()) {
                $style .= "margin-top: " . $this->get_option_value('margin_top_list') . "px; ";
                $style .= "margin-right: " . $this->get_option_value('margin_right_list') . "px; ";
                $style .= "margin-bottom: " . $this->get_option_value('margin_bottom_list') . "px; ";
                $style .= "margin-left: " . $this->get_option_value('margin_left_list') . "px; ";
            }
            if ($this->controller->is_page() or $this->controller->is_article()) {
                $style .= "margin-top: " . $this->get_option_value('margin_top_page') . "px; ";
                $style .= "margin-right: " . $this->get_option_value('margin_right_page') . "px; ";
                $style .= "margin-bottom: " . $this->get_option_value('margin_bottom_page') . "px; ";
                $style .= "margin-left: " . $this->get_option_value('margin_left_page') . "px; ";
            }
            //Padding
            $style .= "padding: 12px; ";
            return $style;
        }
        
        public function render_message() {
			if ($this->get_option('message_text')->is_formatting_enabled()) {
				$message_text = $this->add_html_formatting($this->get_option_value('message_text'));
			} else {
				$message_text = $this->get_option_value('message_text');
			}
			if (function_exists("icl_register_string")) {
				icl_register_string('plugin gc-message-box', 'Message for GC Message Box', $message_text);
				$message_text = icl_t('plugin gc-message-box', 'Message for GC Message Box', $message_text);
			}
            $message = "<span id=\"".$this->namespace."message\">".$message_text."</span>";
            return $message;
        }
        
        public function render_button($class = null) {
			if ($this->get_option('action_button_text')->is_formatting_enabled()) {
				$message = $this->add_html_formatting($this->get_option_value('action_button_text'));
			} else {
				$message = $this->get_option_value('action_button_text');
			}
            if (empty($message)) {
                return;
            }
			if (function_exists("icl_register_string")) {
				icl_register_string('plugin gc-message-box', 'Button Text for GC Message Box', $message);
				$message = icl_t('plugin gc-message-box', 'Button Text for GC Message Box', $message);
			}
            $content = "";
            if ($this->get_option('action_target')->is_checked()) {
                $content = "<a target=\"_blank\" ";
            } else {
                $content = "<a target=\"_top\" ";
            }

            if ($this->get_option('action_nofollow')->is_checked()) {
                $content .= "rel=\"nofollow\" ";
            }

            if ($this->get_option('enable_cloaking')->get_value() == "1") {
                $content .= ' href="?gc_message_box_redirect"';
            } else {
                $href = $this->get_option_value("action_url");

                if (function_exists("icl_register_string")) {
                    icl_register_string('plugin gc-message-bar', 'Button Url for GC Message Box', $href);
                    $href = icl_t('plugin gc-message-bar', 'Button Url for GC Message Box', $href);
                }
                $content .= ' href="'.$href.'"';
            }


            if(!isset($class)){
  	          	$content .= " id=\"gc_message_box_button_a_".$this->gci."\">";
            } else {
	            $content .= "class=\"".$this->namespace.$class."\" id=\"gc_message_box_button_a\">";
            }
            $content .= "<span id=\"".$this->namespace."button\">";
            $content .= "<span id=\"".$this->namespace."buttontext\">".$message;
            $content .= "</span></span></a>";
            return $content;
        }
        
        public function render_animations() {
            if ($this->get_option_value('enable_animation') == '2') {
                return;
            }
            echo "<script type='text/javascript'>
                var bottom = parseInt(window.pageYOffset + jQuery(window).height(),10);
                var pos = 0;
                jQuery('.gc_message_box').each(function() {
                    if(jQuery(this).css('display') == 'none') {
                        jQuery(this).css('display', 'block');
                        pos = jQuery(this).offset().top;
                        jQuery(this).css('display', 'none');
                        if(pos < bottom) {
                            jQuery(this).fadeIn(1000);
                        }
                    }
                });
                jQuery(window).scroll(function() {
                    bottom = parseInt(window.pageYOffset + jQuery(window).height(),10);
                    jQuery('.gc_message_box').each(function() {
                        if(jQuery(this).css('display') == 'none') {
                            jQuery(this).css('display', 'block');
                            pos = jQuery(this).offset().top;
                            jQuery(this).css('display', 'none');
                            if(pos < bottom) {
                                jQuery(this).fadeIn(1000);
                            }
                        }
                    });
                });
            </script>";
        }
		
		protected function add_html_formatting($text) {
			$text = preg_replace('/&lt;b&gt;([\s\S]*)&lt;\/b&gt;/i', '<b>${1}</b>', $text);
			$text = preg_replace('/&lt;s&gt;([\s\S]*)&lt;\/s&gt;/i', '<s>${1}</s>', $text);
			$text = preg_replace('/&lt;i&gt;([\s\S]*)&lt;\/i&gt;/i', '<i>${1}</i>', $text);
			$text = preg_replace('/&lt;u&gt;([\s\S]*)&lt;\/u&gt;/i', '<u>${1}</u>', $text);
			return $text;
		}
        
        protected function get_current_url() {
            $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            if ($_SERVER["SERVER_PORT"] != "80")
            {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } 
            else 
            {
                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }
            return $pageURL;
        }
        
    }
}