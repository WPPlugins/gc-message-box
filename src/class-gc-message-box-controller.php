<?php
if(!class_exists("Gc_Message_Box_Controller")){
    class Gc_Message_Box_Controller implements Gc_MessageBox_Controller_Interface {
		public static $started = false;
	    public static $instance = null;

        protected $namespace;
        protected $first_appear;
        protected $enable_repeat;
        protected $repeat_after;
        protected $gci = 0;
        protected $inloop = false;
        protected $renderer = null;
        protected $metrix_code = null;
        protected $metrix_enable = false;
		protected $max_number = 20;
		protected $force_php = "2";
        protected $options = array();
        protected $debug_render = false;
        const hour = 3600;
        
        public function __construct($namespace){
            $this->namespace = $namespace;
            self::$instance = $this;
        }

        public function initialize(){
            $options = Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance()->get_namespace($this->namespace);

            $this->first_appear = $options->get("first_appear");
            $this->enable_repeat = $options->get("enable_repeat");
            $this->repeat_after = $options->get("repeat_after");
            $this->metrix_code = $options->get("metrix_code");
            $this->metrix_enable = ($this->metrix_code->get_value() != "");
            $this->renderer = new Gc_Message_Box_Renderer($this->namespace, $this);
			$this->max_number = $options->get("maximum_number")->get_value();
			$this->force_php = $options->get("force_php")->get_value();
            $this->options = $options;
        }

        public function initialize_hooks(){
            add_action( 'setup_theme', array($this,'remote'));
            add_action( 'init', array($this, 'scripts_init') );
            add_action( 'wp_before_admin_bar_render', array($this, 'init_admin_bar') );
            if ($this->is_box_enabled() || $this->is_remote_debug_enabled()) {

                add_action( 'init', array($this, 'handle_cloaked_link') );
                add_action( 'the_post', array($this,'put_after_the_post'), 1 );
                add_action( 'loop_start', array($this,'put_loop_start'), 1 );
                add_action( 'loop_end', array($this,'put_loop_end'), 1 );
    			add_action( 'pre_get_posts', array($this,'reset_loop'), 1 );
                add_filter( 'comments_array', array($this,'comments_list_before'), 1 );
                add_action( 'wp_footer', array($this->renderer, 'render_animations') );
                add_action( 'wp_head', array($this, 'jquery_scripts'));
                add_action( 'init', array($this, 'setup_cookies') );
                add_shortcode( 'gc-message-box', array($this, 'short_code') );
                add_action( 'widgets_init', array($this, 'register_widget') );            
            }
        }

        public function register_widget() {
            register_widget( 'Gc_Message_Box_Widget' );
        }



        public function remote(){
            $worker = Gc_MessageBox_CF::create_and_init("Mygetconversion_Worker",array("type" => Gc_MessageBox_Util::get_type()));
            $worker->add_handler("add_metrix_code",new Gc_Message_Box_Addmetrixcode_Action($this->namespace));
            $worker->add_handler("info",new Gc_Message_Box_Info_Action($this->namespace));
            $request = Gc_MessageBox_CF::create("Request");

            $worker->execute($request);
            
            if (false == $this->is_box_enabled()) {
                if($this->is_remote_debug_enabled()){
                    $params = $this->decode_action($request);
                    if(!$params){
                        return false;
                    }
                    if($params["action"] == "show"){
                        $this->debug_render = true;
                    }
                }
                return;
            }

        }

        public function is_debug_render(){
            return $this->debug_render;
        }

        public function handle_request(){

        }

        protected function decode_action($request){
            if(false == $request->has_param(md5("gc_message_box_remote_action"))){
                return false;
            }
            $raw_data = urldecode($request->get_param(md5("gc_message_box_remote_action")));
            if(false == Gc_MessageBox_Mygetconversion_Worker::is_signature_valid($raw_data)){
                return false;
            }
            return Gc_MessageBox_Mygetconversion_Worker::decode_param($raw_data);

        }

        
        public function jquery_scripts() {
            wp_enqueue_script( 'utils' );
        }
        
        public function setup_cookies() {
            $options = Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance()->get_namespace($this->namespace);
            $request = (array)Gc_MessageBox_CF::create("Request");
            $expires = ($options->get("state_cookie_time")->get_value()) ? $options->get("state_cookie_time")->get_value() : 0;
            if (isset($request["data"]["close_".$this->namespace])) {
                setcookie($this->namespace . 'cookie', 'closed', time() + self::hour * $expires,'/');
                $_COOKIE[$this->namespace . 'cookie'] = 'closed';
            }
        }
        
        public function plugin_options_url() {
            return Gc_MessageBox_Util::plugin_options_url();
        }

        public function scripts_init(){
            global $GC_Message_Box_Config;
            wp_enqueue_script( 'jquery' );
            $this->load_generated_css();
            wp_register_style( 'google_webfonts', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|PT+Sans:400,700,400italic,700italic|Bitter:400,700,400italic|Droid+Serif:400,700,700italic,400italic|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,800,700,600,300|Oswald:400,700,300|Open+Sans+Condensed:300,300italic,700|Yanone+Kaffeesatz:400,700,300,200|Roboto:400,900italic,700italic,900,700,500italic,500,400italic,300italic,300,100italic,100&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese' );
            wp_enqueue_style('google_webfonts');

            Gc_Message_Box_Admin_Bar::script_init();

            if($this->metrix_enable){
                $httpPrefix = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
                wp_enqueue_script( 'metrix', $httpPrefix.$GC_Message_Box_Config['METRIX_JS_URL']);
            }

        }

        protected function load_generated_css(){
            $css_handling = $this->options->get("css_handling")->get_value();
            if($css_handling == 1){
                wp_register_style( GC_MESSAGE_BOX_TYPE.'-generated', plugins_url('gc-message-box/style-gc-message-box.php'), array(), false, "screen" );
                wp_enqueue_style( GC_MESSAGE_BOX_TYPE.'-generated' );
                return;                
            }
            if($css_handling == 2){

                $cache_path = $this->options->get("cache_directory")->get_value();
                $cache = Gc_MessageBox_CF::create_and_init("Cache",array(
                    "cache_dir" => $cache_path
                    ));
                $file_name = "style-".GC_MESSAGE_BOX_TYPE.".css";
                if($cache->is_file_exists($file_name)){
                    $url = $cache->get_cache_file_url($file_name);
                    wp_register_style( GC_MESSAGE_BOX_TYPE.'-generated', $url, array(), false, "screen" );
                    wp_enqueue_style( GC_MESSAGE_BOX_TYPE.'-generated' );                
                } else {

                    add_action( 'wp_print_styles', array($this,'generate_css'));
                }
                return;                
            }
            if($css_handling == 3){
                add_action( 'wp_print_styles', array($this,'generate_css'));
                return;                

            }

        }

        public function generate_css(){
            $renderer = new Gc_Message_Box_Style_Renderer(GC_MESSAGE_BOX_NS);
            $renderer->configure(
                array(
                    "echo" => false,
                    "minify" => true
                ));
            $custom_css = $renderer->render(array());
            echo '<style type="text/css" id="'.GC_MESSAGE_BOX_TYPE.'-generated">
            '.$custom_css.'
           </style>
        ';
        }


        public function short_code(){
            if ( is_feed() ) {
                return;
            }
            
            if(isset($_COOKIE[$this->namespace . 'cookie']) and $_COOKIE[$this->namespace . 'cookie'] == 'closed') {
                return;
            }
            $this->render_with_random_id();
        }
		public function render_with_random_id(){
            $this->render(false,true);
        }
        public function render($with_animation = false,$with_random_id = false){
            if($with_random_id){
                $random_id = str_replace(".","_",microtime(true));

            } else{
                $random_id = false;
            }
           echo $this->renderer->render($this->gci,$random_id);
           if($with_random_id){
               echo $this->render_metrix_tracker($random_id);
           } else{
               echo $this->render_metrix_tracker($this->gci);
           }
           if($with_animation){
            $this->renderer->render_animations();
           }

        }
		public function reset_loop() {
			wp_reset_query();
		}

        public function put_loop_start($query) {
			global $wp_the_query;
			
            $this->gci = 0;
            if ( ($query === $wp_the_query) && $query->is_main_query()) {
                $this->inloop = true;
            }
        }

        public function is_box_enabled() {
            return ($this->options->get('box_enable')->get_value() == "1");
        }

        public function is_remote_debug_enabled() {
            return ($this->options->get('enable_remote_debug')->get_value() == "1");
        }

        public function put_after_the_post(){
            if ( is_feed() ) {
                return;
            }
			if ($this->force_php == "1" && !self::$started) {
				return;
			}
            //Loop end
            if(!$this->inloop){
                return;
            }
            //Post page
            if(is_single()){
                return;
            }
            //Page page
            if(is_page()){
                return;
            }
            //Appear here test
            if (!$this->is_appear_here_enabled()) {
                return;
            }
            if(!$this->is_device_filter()){
                return;
            }
            
            if (!$this->user_can_role()) {
                return;
            }
            if(!$this->is_auth_filter()){
                return;
            }
			
			if ($this->gci > $this->max_number) {
				return;
			}
            if(isset($_COOKIE[$this->namespace . 'cookie']) and $_COOKIE[$this->namespace . 'cookie'] == 'closed') {
                return;
            }

            if($this->options->get('groups')->get_value() == 1){
                if(is_plugin_active('groups'.DIRECTORY_SEPARATOR .'groups.php')) {
                    $groups = implode(",",array_keys(unserialize(htmlspecialchars_decode($this->options->get('group_filter_list')->get_value()))));
                    $group_enable = do_shortcode("[groups_member group=\"$groups\"]true[/groups_member]");
                    if($group_enable != 'true'){
                        return;
                    }
                }
            }

            if($this->is_loop_counter_equal_first_appear()) {
                $this->render();

            }
            if($this->is_repeat_enable()){
                if($this->is_loop_counter_less_first_appear()){
                    if($this->is_repeat_position()){
                        $this->render();
                    }
                }
            }

            $this->gci++;

        }

        public function put_loop_end(  ) {
            $this->inloop = false;
        }

        public function comments_list_before($my_comments){
            if(!$this->is_device_filter()){
                return;
            }
            if (!$this->user_can_role()) {
                return false;
            }
            if(!$this->is_auth_filter()){
                return;
            }            
            if(isset($_COOKIE[$this->namespace . 'cookie']) and $_COOKIE[$this->namespace . 'cookie'] == 'closed') {
                return;
            }

            if ($this->is_appear_here_enabled()) {
                $this->render();
            }
            return $my_comments;
        }

        public function user_can_role() {
            if ($this->options->get('role_filter')->get_value() == "1") {
                $cur_user_roles = $this->get_user_roles();
                if (in_array('administrator', $cur_user_roles)) {
                    return true;
                }
                $roles_enabled = array_keys(unserialize(htmlspecialchars_decode($this->options->get('role_filter_list')->get_value())));
                foreach($cur_user_roles as $role) {
                    if (in_array($role, $roles_enabled)) {
                        return true;
                    }
                }
                return false;
            }
            return true;
        }

        protected function get_user_roles() {
            $user = wp_get_current_user();
            if ( empty( $user ) ) {
                return false;
            }
            return (array)$user->roles;
        }
        public function is_device_filter() {
            if($this->options->get('device_filter')->get_value() == "2"){
                return true;
            }
            if($this->options->get('device_filter')->get_value() == "1" and !wp_is_mobile()){
                return true;
            }
            if($this->options->get('device_filter')->get_value() == "3" and wp_is_mobile()){
                return true;
            }
            return false;
        }


        public function is_auth_filter() {
            if ($this->options->get('auth_filter')->get_value() == '2' && !is_user_logged_in()) {
                return false;
            }
            if ($this->options->get('auth_filter')->get_value() == '3' && is_user_logged_in()) {
                return false;
            }
            return true;
        }


        public function render_metrix_tracker($index){
            global $GC_Message_Box_Config;
            if(!$this->metrix_enable){
                return;
            }

            $metrix_helper = Gc_MessageBox_CF::create_and_init("Metrix_Helper",array(
                "endpoint_url" => $GC_Message_Box_Config['METRIX_ENDPOINT_URL'],
                "click_id" => "gc_message_box_button_a_".$index,
                "metrix_code" => $this->metrix_code
                )
            );
            $metrix_helper->render();

        }
        
        public function is_list() {
            return (is_home() || is_category() || is_search() || is_author() || is_archive() || is_tag());
        }
        
        public function is_article() {
            return is_single();
        }

        public function is_page() {
            return is_page();
        }


        protected function is_loop_counter_equal_first_appear(){
            return ($this->gci == $this->first_appear->get_value());
        }

        protected function is_loop_counter_less_first_appear(){
            return ((int)$this->first_appear->get_value() < $this->gci);
        }

        protected function is_repeat_enable(){
            return ($this->enable_repeat->is_checked());
        }

        protected function is_repeat_position(){
            return ((($this->gci - $this->first_appear->get_value()) % $this->repeat_after->get_value()) == 0);
        }

        protected function is_appear_here_enabled() {
            $options = Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance()->get_namespace($this->namespace);
			$pages = unserialize(htmlspecialchars_decode($options->get('displayed_pages')->get_value()));
			$pages = ($pages == false) ? array() : $pages;
			$filter = $options->get('appear_here')->get_value();
			$url = $this->get_current_url();
			switch($filter) {
				case "1":
					return true;
					break;
				case "2":
					if ($options->get("appear_here")->is_checked()) {
						return true;
					}
					$page_functions = array(
						"is_home"       =>  "appear_here_home",
						"is_category"   =>  "appear_here_category",
						"is_tag"        =>  "appear_here_tag",
						"is_archive"    =>  "appear_here_archive",
						"is_author"     =>  "appear_here_author",
						"is_search"     =>  "appear_here_search",
						"is_single"     =>  "appear_here_article",
						"is_page"       =>  "appear_here_pages"
					);
					$appear_pages = $options->filter("get_group", "filters_appear_here");
					foreach ($page_functions as $function => $opt) {
						if($function()) {
							return ($appear_pages[$opt]->is_checked());
						}
					}   
					return false;
					break;
				case "displayed_pages_allow":
                    return $this->hanlde_allow_deny_filter($url, $pages);
					break;
				case "displayed_pages_deny":
                    return !$this->hanlde_allow_deny_filter($url, $pages);
					break;
			}
        }
    protected function hanlde_allow_deny_filter($url,$pages){
        $filter = Gc_MessageBox_CF::create_and_init("Url_filter",
            array(
                "url_list" => $pages
                )
        );
        return $filter->is_allowed($url);
    }
    public function handle_cloaked_link() {
        $request = Gc_MessageBox_CF::create("Request");
        if(!$request->has_param("gc_message_box_redirect")){
            return;
        }
        header('location: '.$this->options->get("action_url")->get_value());
        exit();
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

    public function init_admin_bar() {
		$options = Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance()->get_namespace($this->namespace);
		if ($options->get("enable_adminbar")->get_value() == "1" && current_user_can('administrator')) {
			$bar = new Gc_Message_Box_Admin_Bar();
			$bar->initialize($this->plugin_options_url());
		}
    }

    }
}

function gc_message_box_mainloop_start() {
	Gc_Message_Box_Controller::$started = true;
}

function gc_message_box_mainloop_stop() {
	Gc_Message_Box_Controller::$started = false;
}