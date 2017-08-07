<?php
if(class_exists('Gc_MessageBox_Theme_Repository')) {
    return;
}
class Gc_MessageBox_Theme_Repository{

    protected $themes = array();

    public function add_theme($theme){
        if(isset($this->themes[$namespace])){
            return;
        }
        $this->themes[$theme] = array();
    }

    public function init_themes($themes){
        $this->themes = $themes;
    }

    public function get($theme){
        $res = $this->create_theme();
        if(isset($this->themes[$theme])){
            $res->load_from_array($this->themes[$theme]);
        }
        return $res;
    }

    public function get_count(){
        return count($this->themes);
    }

    public function get_all(){
        $themes = array();
        foreach ($this->themes as $id => $theme) {
            $res = $this->create_theme();
            $res->load_from_array($theme);
            $themes[$id] = $res;
        }
        return $themes;
    }

    protected function create_theme(){
        return Gc_MessageBox_CF::create("Theme");
    }
}