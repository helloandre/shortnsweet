<?php
class Error extends Exception {
    var $http_code;
    
    function __construct($msg, $code = false) {
        parent::__construct($msg);
        $this->http_code = $code;
    }
    
    function getHTTPCode() {
        return $this->http_code;
    }
    
}
?>