<?php

class Gc_Message_Box_Align_Renderer {

    private $content = "";
    private $renderer;
    private $namespace;
    private $id;
    private $align;
    private $aligns = array(
            1 => array("button_bottom_align", "centered_under"),
            2 => array("button_bottom_align", "left_under"),
            3 => array("button_bottom_align", "right_under"),
            4 => array("button_top_align", "left_inline"),
            5 => array("button_top_align", "right_inline"),
            6 => array("button_top_align", "left_right_far"),
            7 => array("button_bottom_align", "right_left_far"),
            8 => array("button_top_align", "left_right_close"),
            9 => array("button_bottom_align", "right_left_close")
        );

    public function __construct($align, $renderer) {
        //Based on the button's alignment
        $this->renderer = $renderer;
        $this->namespace = $this->renderer->get_namespace();
        $this->align = $align;
        $this->id = $this->aligns[$align][1];
    }
    
    public function render() {
        $align = $this->aligns[$this->align][0];

        if(!is_string($align)){
            return;
        }
        $this->$align();
        return "<div class=\"".$this->namespace . $this->id ."_box\">".$this->content."</div>";
    }
        
    private function button_top_align() {
        $this->content =  "<div class=\"".$this->namespace . $this->id ."_btn\">".$this->renderer->render_button()."</div>";
        $this->content .= "<div class=\"".$this->namespace . $this->id ."_msg\">".$this->renderer->render_message()."</div>";
        $this->content .= "<div class=\"gc_message_box_clear\"></div>";
    }
    
    private function button_bottom_align() {
        $this->content =  "<div class=\"".$this->namespace . $this->id ."_msg\">".$this->renderer->render_message()."</div>";
        $this->content .= "<div class=\"".$this->namespace . $this->id ."_btn\">".$this->renderer->render_button()."</div>";
        $this->content .= "<div class=\"gc_message_box_clear\"></div>";
    }
    
}