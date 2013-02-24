<?php

class Upload {
    
    static private $object;
    
    static function run() {
        self::determine_object();
        
        self::$object->save();
        
        return self::out();
    }
    
    static function determine_object() {
        // determine what we're working with
        if (isset($_REQUEST['url'])) {
            self::$object = new Url($_REQUEST['url']);
        } else if (isset($_FILES['file'])) {
            self::$object = new File($_FILES['file']);
        } else {
            throw new Error_EmptyUpload("nothing to upload", 404);
        }
    }
    
    static function out() {
        return array(
            'url' => SnS::make_url(self::$object->short), 
            'long' => self::$object->long, 
            'name' => self::$object->name
        );
    }
}

?>
