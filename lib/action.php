<?php

class Action {
    
    static function upload() {
        Response::output_json();
        
        $data = Upload::run();
        Response::success($data);
    }
    
    static function view() {
        $template = View::run();
        
        // view template
        include $template;
    }
}

?>