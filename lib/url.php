<?php

class Url extends Object {
    
    function __construct($upload_data) {
        parent::__construct();
        
        $this->long = $upload_data;
        $this->type = SNS_TYPE_URL;
        
        if (substr($this->long, 0, 7) !== "http://" && substr($this->long, 0, 8) !== "https://") {
            $this->long = "http://" . $this->long;
        }
    }
    
    public function save() {
        $valid_gsb = Config::$gsb_key ? $this->check_gsb() : true;
        
        if (!$this->check_valid()) {
            throw new Error_Save("invalud url");
        }
        if (!$valid_gsb) {
            throw new Error_Save("unsafe url");
        }
        if (!parent::save()) {
            throw new Error_Save("could not save url");
        }
    }

    private function check_gsb(){
        // google safe browsing http://code.google.com/apis/safebrowsing/
        $gsb_url = 'https://sb-ssl.google.com/safebrowsing/api/lookup?client=shortnsweet&apikey='.Config::$gsb_key.'&appver=1.5.2&pver=3.0&url='.urlencode($this->long);
        
        // http://code.google.com/apis/safebrowsing/lookup_guide.html#HTTPGETRequestResponseCode
        return $this->_get_resp($gsb_url) == 204;
    }
    
    private function check_valid() {
        return $this->_get_resp($this->long) == 200;
    }
    
    private function _get_resp($url) {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        
        $resp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return $resp;
    }
}
?>