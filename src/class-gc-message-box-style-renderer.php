<?php
if(class_exists("Gc_Message_Box_Style_Renderer")){
	return;
}
class Gc_Message_Box_Style_Renderer 
extends 
	Gc_MessageBox_Abstract_Renderer
implements 
	Gc_MessageBox_Configurable_Interface
{
    protected $echo = true;
    protected $minify = false;
    protected $dev_mode = false;
    public function __construct($namespace){
        parent::__construct($namespace,null);
            

	}

	protected function get_options(){
		return Gc_MessageBox_CF::create("Option_Repository_Factory")->get_instance()->get_namespace($this->namespace);
	}
	
    public function configure(array $options){
        $this->configure_field($options,"echo");
        $this->configure_field($options,"minify");
        $this->configure_field($options,"dev_mode");
    }

    protected function configure_field(array $options,$field_name){
        if(isset($options[$field_name])){
            $this->$field_name = $options[$field_name];
        }
    }

	public function render($params ) {
	    $options = $this->get_options();
	    $config = Gc_MessageBox_Service_Locator::get(GC_MESSAGE_BOX_SL_CONFIG);
	    $css_content = "";
        if($dev_mode){
            $css_content .= "/*".PHP_EOL.__FILE__.PHP_EOL."*/".PHP_EOL;            
        }
	    $styleZindexDefault = '99998';
	    $styleZindex = $options->get('z_index')->get_value();
        $gc_message_box_namespace = $this->namespace;
	    $event_manager = Gc_MessageBox_Service_Locator::get(GC_MESSAGE_BOX_SL_EVENT_MANAGER);
		$css_content = 
"	    
/* CONTENT */
.gc_message_box div,
.gc_message_box span,
.gc_message_box b,
.gc_message_box i,
.gc_message_box form,
.gc_message_box label {
    line-height: 1;
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
}
.gc_message_box a {
    margin: 0;
    padding: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
}
.gc_message_box input,
.gc_message_box select {
    vertical-align: middle;
}

.gc_message_box {
    position: relative;
";    
    if($options->get("box_shadow")->get_value() == 1){
        $css_content .= $this->generate_box_shadow("0 8px 6px -6px","0,0,0,0.3");   
    }
    $css_content .= $this->generate_gradient('background_color');
    $css_content .= 
"    
    -webkit-border-radius: ".$options->get('box_corner_radius')->get_value()."px;
    -moz-border-radius: ".$options->get('box_corner_radius')->get_value()."px;
    border-radius: ".$options->get('box_corner_radius')->get_value()."px;
}

.gc_message_box #gc_message_box_message {
    margin: 0 10px;
    vertical-align: middle;
    position: relative;
    overflow: hidden;
    display: inline-block;
    line-height: 30px;
    color: ".$options->get('message_color')->get_value().";
".$this->generate_shadow('message_shadow').
"
    font-family: ".$options->get('message_font')->get_value().";
    font-size: ".$options->get('message_font_size')->get_value().";
}

.gc_message_box a {
    text-decoration: none;
}
.gc_message_box #gc_message_box_button_a {
    background: none !important;
}

.gc_message_box #gc_message_box_button #gc_message_box_buttontext {
    width: 100%;
    height: 28px;
    line-height: 28px;
    display: inline-block;
    position: relative;
    overflow: hidden;
    vertical-align: top;
    padding: 0;
    margin: 0;
    font-family: ".$options->get('action_button_font')->get_value().";
    font-size: ".$options->get('action_button_font_size')->get_value().";
}

.gc_message_box #gc_message_box_button #gc_message_box_buttontext:hover {
}

.gc_message_box #gc_message_box_button {
    display: inline-block;
    vertical-align: top;
    position: relative;
    overflow: hidden;
    text-align: center;
    height: 28px;
    line-height: 28px;
    padding: 0 10px;
    cursor: pointer;
    color: ".$options->get('action_button_text_color')->get_value().";";    
    if ($options->get('action_button_shadow')->get_value() == '1'){
        $css_content .= $this->generate_box_shadow("2px 2px 3px","0,0,0,0.2");        
    }
    $css_content .= 
"       
    -webkit-border-radius: ".$options->get('action_button_corner_radius')->get_value()."px;
    -moz-border-radius: ".$options->get('action_button_corner_radius')->get_value()."px;
    border-radius: ".$options->get('action_button_corner_radius')->get_value()."px;
    border: 1px solid ".$options->get('action_button_border_color')->get_value().";
".
$this->generate_gradient('action_button_color')."
".
$this->generate_shadow('button_shadow').
"
}

.gc_message_box #gc_message_box_button:hover {
    color: ".$options->get('action_button_hover_text_color')->get_value().";
    border: 1px solid ".$options->get('action_button_hover_border_color')->get_value().";
".
$this->generate_gradient('action_button_hover')."
".
$this->generate_shadow('button_hover_shadow').
"
}

.gc_message_box .close_icon {
    display: block;
    position: absolute;
    z-index: 99997;
    right: 4px;
    top: 4px;
    height: 15px;
    width: 15px;
    background-image: url('".plugins_url()."/gc-message-box/images/x-light.png');
    background-repeat: no-repeat;
    background-position: center center;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    opacity: 0.5;
    cursor: pointer;
}
.gc_message_box .dark.close_icon {
    background-image: url('".plugins_url()."/gc-message-box/images/x-dark.png');
}
.gc_message_box .close_icon:hover {
    background-color: rgba(0,0,0,0.5);
    opacity: 0.7;
}
.gc_message_box .dark.close_icon:hover {
    background-color: rgba(255,255,255,0.5);
}

/* ALIGNS */

/* CENTERED UNDER */
.".$gc_message_box_namespace."centered_under_msg { 
    text-align: center; 
    padding-bottom: 10px; 
    line-height: 30px; 
}
.".$gc_message_box_namespace."centered_under_btn { 
    text-align: center; 
}

/* LEFT UNDER */
.".$gc_message_box_namespace."left_under_msg { 
    text-align: left; 
    padding-bottom: 10px; 
    line-height: 30px; 
}
.".$gc_message_box_namespace."left_under_btn { 
    text-align: left; 
}

/* RIGHT UNDER */
.".$gc_message_box_namespace."right_under_msg { 
    text-align: right; 
    padding-bottom: 10px; 
    line-height: 30px; 
}
.".$gc_message_box_namespace."right_under_btn { 
    text-align: right; 
}

/* LEFT INLINE */
.".$gc_message_box_namespace."right_inline_box {
    text-align: left; 
}
.".$gc_message_box_namespace."left_inline_box .gc_message_box_clear {
    clear: left;
}
.".$gc_message_box_namespace."left_inline_msg { 
    text-align: left; 
    display: inline-block;
    line-height: 30px; 
}
.".$gc_message_box_namespace."left_inline_btn { 
    float: left; 
    text-align: left; 
    display: inline; 
    padding-right: 10px; 
}

/* RIGHT INLINE */
.".$gc_message_box_namespace."right_inline_box {
    text-align: right;
}
.".$gc_message_box_namespace."right_inline_box .gc_message_box_clear {
    clear: left;
}
.".$gc_message_box_namespace."right_inline_msg {  
    text-align: right; 
    display: inline-block;
    line-height: 30px;
}
.".$gc_message_box_namespace."right_inline_btn { 
    float: right; 
    text-align: right;
    display: inline; 
    padding-left: 10px; 
}

/* LEFT RIGHT FAR */
.".$gc_message_box_namespace."left_right_far_box .gc_message_box_clear {
    clear: left;
}
.".$gc_message_box_namespace."left_right_far_msg { 
    float: right; 
    text-align: right; 
    display: inline-block;
    line-height: 30px; 
}
.".$gc_message_box_namespace."left_right_far_btn { 
    float: left;
    text-align: left; 
    display: inline; 
}

/* RIGHT LEFT FAR */
.".$gc_message_box_namespace."right_left_far_box .gc_message_box_clear {
    clear: left;
}
.".$gc_message_box_namespace."right_left_far_msg { 
    float: left; 
    text-align: left;
    display: inline-block;
    line-height: 30px; 
}
.".$gc_message_box_namespace."right_left_far_btn { 
    float: right; 
    text-align: right; 
    display: inline; 
}

/* RIGHT LEFT CLOSE */
.".$gc_message_box_namespace."right_left_close_box { 
    text-align: center; 
}
.".$gc_message_box_namespace."right_left_close_msg { 
    padding-right: 10px; 
    display: inline-block;
    line-height: 30px;
}
.".$gc_message_box_namespace."right_left_close_btn {
    display: inline;
}

/* LEFT RIGHT CLOSE */
.".$gc_message_box_namespace."left_right_close_box {
    text-align: center; 
}
.".$gc_message_box_namespace."left_right_close_msg {
    display: inline-block;
    vertical-align: middle !important;
    line-height: 30px;
    padding-left: 10px;
}
.".$gc_message_box_namespace."left_right_close_btn {
    display: inline; 
}
";
        $event = new Gc_MessageBox_Event(
        array(
            "options" => $options,
            "params"  => array(
                "echo" => $this->echo,
                "minify" => $this->minify
                )
            )
        );
        if($this->echo){
            echo $css_content;
    		$event_manager->dispatch(GC_MESSAGE_BOX_NAME.".render_style",$event);
        }else{
            $event_manager->dispatch(GC_MESSAGE_BOX_NAME.".render_style",$event);
            $result = $event->get_result();
            $css_content .= $result;
            if($this->minify){
                return $this->minify($css_content);
            }
            return $css_content;

        }

	}

    public function minify($css_content){
// Remove comments
$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_content);
 
// Remove space after colons
$buffer = str_replace(': ', ':', $buffer);
 
// Remove whitespace
$buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);

$buffer = preg_replace( '/\s+/', ' ', $buffer );
return $buffer;
    }

    public function generate_shadow($layout) {
        $options = $this->get_options();
        $layout = $options->get($layout)->get_value();
        if ( $options->get('text_shadow')->get_value() == "1") {
            switch($layout) {
                case "1":
                    return 
"    text-shadow: 1px 1px 1px rgba(255,255,255,.3);";                
                case "2":
                    return 
"    text-shadow: 1px 1px 1px rgba(0,0,0,.3);";
            }
        }
        return null;
    }
    
    public function generate_gradient($layout) {
        $options = $this->get_options();
            return 
"    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='" .$options->get($layout.'2')->get_value(). "', endColorstr='" .$options->get($layout)->get_value(). "',GradientType=0);
    background: " .$options->get($layout)->get_value(). ";
    background: -moz-linear-gradient(top, " .$options->get($layout.'2')->get_value(). " 0%, ". $options->get($layout)->get_value(). " 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, " .$options->get($layout.'2')->get_value(). "), color-stop(100%, ".$options->get($layout)->get_value()."));
    background: -o-linear-gradient(top, " .$options->get($layout.'2')->get_value(). " 0%, " .$options->get($layout)->get_value(). " 100%);
    background: -ms-linear-gradient(top, " .$options->get($layout.'2')->get_value(). " 0%, " .$options->get($layout)->get_value(). " 100%);
    background: linear-gradient(to bottom, " .$options->get($layout.'2')->get_value(). " 0%, " .$options->get($layout)->get_value(). " 100%);
    background: -webkit-linear-gradient(top, " .$options->get($layout.'2')->get_value(). " 0%, " .$options->get($layout)->get_value(). " 100%);";
    }


    

    public function generate_box_shadow($pixels,$color,$important = ""){
        $content = 
    "    -moz-box-shadow: ".$pixesls."  rgba(".$color.") ".$important.";
    -webkit-box-shadow: ".$pixesls."  rgba(".$color.") ".$important.";
    box-shadow: ".$pixesls."  rgba(".$color.") ".$important.";".PHP_EOL;
        if($this->dev_mode){
            $content = "    /* ".__FUNCTION__." start */".PHP_EOL.
            $content."    /* ".__FUNCTION__." end */".PHP_EOL;
        }
        return $content;

    }

}