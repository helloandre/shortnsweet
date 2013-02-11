<?php

class Response {
    
    static function output_json() {
        header("Content-type: application/json");
    }
    
    static function redirect($url) {
        header('Location: ' . $url);
    }
    
    static function out($msg = array()){
        die(json_encode($msg));
    }
    
    static function success($extras = array()) {
        self::out(array_merge(array('success' => true), $extras));
    }
    
    static function fail($error = "there was an error", $extras = array()) {
        self::out(array_merge(array('success' => false, 'error' => $error), $extras));
    }
    
}

?>