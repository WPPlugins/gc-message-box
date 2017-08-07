<?php
if(!class_exists("Gc_Message_Box_Widget")){
	class Gc_Message_Box_Widget extends WP_Widget {
		public function __construct() {
			parent::__construct(
				'gc_message_box_widget', // Base ID
				__('GC Message Box', 'gc_message_box'), // Name
				array( 'description' => __( 'Use this widget to add GC Message Box as a widget', 'gc_message_box' ), ) // Args
			);
		}

		protected function is_controller(){
			return 	($this->controller != null);

		}

		public function widget( $args, $instance ) {
			extract( $args );
			$controller = Gc_Message_Box_Controller::$instance;
			if($controller == null){
				return;
			}
			echo $before_widget;
			$controller->short_code();
			echo $after_widget;
		}

	 	public function form( $instance ) {
			$controller = Gc_Message_Box_Admin_Controller::$instance;
			if($controller == null){
				return;
			}
			?>
			This widget works with the main GC Message Box settings. Click here to customize: <a href="<?php echo $controller->plugin_options_url(); ?>"><b><?php echo __( 'Settings' ); ?></b></a>
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			return;
		}
	}
}