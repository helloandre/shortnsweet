<?php

class File extends Object {
    
    var $tmp;
    var $loc;
    
    function __construct($upload_data) {
        parent::__construct();
        
        $this->name = $upload_data['name'][0];
        $this->tmp = $upload_data['tmp_name'][0];
        $this->type = SNS_TYPE_FILE;
        
        $this->generate_long();
    }
    
    public function save() {
        if (!parent::save() || !$this->store_file()) {
            throw new Error_Save("could not save file");
        }
        
        // override long now so we can display it properly
        $this->long = SnS::make_url("file/" . $this->short . "-" . $this->long);
    }
    
    private function generate_long() {
        $this->long = preg_replace("/[^a-zA-Z0-9]+/", "-", $this->name);
    }
    
    private function store_file(){
        $this->loc = SnS::$files_base . $this->short . "-" . $this->long;
        
        return move_uploaded_file($this->tmp, $this->loc);
    }
}

?>
