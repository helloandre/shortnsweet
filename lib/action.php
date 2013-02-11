<?php

class Action {
    
    static function upload() {
        Response::output_json();
        
        $data = Upload::run();
        Response::success($data);
    }
    
    static function view() {
        // fetch / set vars
        View::init();
        
        // view template
        include "../web/view.php";
    }
}

?>