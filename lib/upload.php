<?php

class Upload {
    
    static function run() {
        
        // determine what we're working with
        if (isset($_REQUEST['url'])) {
            $object = new Url($_REQUEST['url']);
        } else if (isset($_FILES['files'])) {
            $object = new File($_FILES['files']);
        } else {
            throw new Error_EmptyUpload("nothing to upload");
        }
        
        $object->save();
        
        return array('url' => SnS::make_url($object->short), 'long' => $object->long, 'name' => $object->name);
    }
}

?>
