<?php

define("SNS_TYPE_FILE", 0);
define("SNS_TYPE_URL", 1);

class SnS {
    
    static $files_base;
    
    static private $_data = array();
    
    static function init() {
        // override autoloader
        spl_autoload_register('SnS::autoload');
        
        self::$files_base = dirname(dirname(__FILE__)) . "/files/";
        
        Db::init();
    }
    
    static function run() {
        $action = self::determine_action();
        Action::$action();
    }
    
    static function determine_action() {
        $action = $_GET['action'];
        
        if (is_callable(array('Action', $action))) {
            return $action;
        } else {
            throw new Error_InvalidAction("invalid action");
        }
    } 
    
    static function autoload($class) {
        include dirname(__FILE__) . "/" . strtolower(str_replace("_", "/", $class)) . ".php";
    }
    
    static function make_url($short) {
        return "http://" . Config::$site_url . "/" . $short;
    }
    
    static function set_data($key, $value) {
        self::$_data[$key] = $value;
    }
    
    static function get_data($key) {
        if (isset(self::$_data[$key])) {
            return self::$_data[$key];
        } else {
            return null;
        }
    }
}

