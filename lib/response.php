<?php

class Response {
    static $response_codes = array(
        '404' => 'Not Found'  
    );
    
    static function output_json() {
        header("Content-type: application/json");
    }
    
    static function redirect($url) {
        header('Location: ' . $url);
    }
    
    static function out($msg = array(), $code = 404){
        if ($code !== 200) {
            header("HTTP/1.0 $code ". self::$response_codes[$code]);
        }
        echo json_encode($msg);
        die();
    }
    
    static function success($extras = array()) {
        self::out(array_merge(array('success' => true), $extras), 200);
    }
    
    static function fail($error = "there was an error", $error_code) {
        self::out(array('success' => false, 'error' => $error), $error_code);
    }
    
}

?>