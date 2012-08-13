<?php
include('lib.php');

Db::init();

class Up {
    var $file = null;
    var $site = null;
    var $img_data = null;
    var $message = null;

    function __construct(){

        if (!array_key_exists('image_data', $_POST) && !array_key_exists('media', $_FILES) && !array_key_exists('site', $_GET)){
            Response::out('empty');
        }

        if (array_key_exists('media', $_FILES)) $this->file = $_FILES['media'];
        if (array_key_exists('site', $_GET)) $this->site = $_GET['site'];
        if (array_key_exists('image_data', $_POST)) $this->img_data = $_POST['image_data'];
        if (array_key_exists('message', $_POST)) $this->message = $_POST['message']; // for twitter client
    }

    function run(){
        $this->get_names();
        // if we've already shortened it before, don't duplicate the entry
        $this->detect_exists();

        if ($this->site && $this->config->gsb_key){
            $this->check_gsb();
        }

        $this->generate_name();

        if ($this->file){
            $this->save_file();
        } else if ($this->site){
            Db::save($this->short, $this->site, 1);
        } else if ($this->image_data){
            $this->save_image_data();
        }

        Response::url($this->short);
    }

    function detect_exists(){
        if ($this->site && array_key_exists($this->site, $this->names)){
            Response::url($this->names[$this->site]);
        }
    }

    function get_names(){
        $names = array();
        $shorts = Db::q("SELECT `long`, `short` FROM `shorten`");
        // build array of previously used names
        while ($row = mysql_fetch_assoc($shorts)){
            $names[$row['long']] = $row['short'];
        }
        $this->names = $names;
    }

    function check_gsb(){
        // google safe browsing http://code.google.com/apis/safebrowsing/
        $gsb_url = 'https://sb-ssl.google.com/safebrowsing/api/lookup?client=shortnsweet&apikey='.Config::$gsb_key.'&appver=1.5.2&pver=3.0&url='.urlencode($this->site);
        // for codes:
        // http://code.google.com/apis/safebrowsing/lookup_guide.html#HTTPGETRequestResponseCode
        if (Config::get_resp_code($gsb_url) != 204){
            Response::out('bad url');
        }

        // if the link given does not return a-ok, assume it is spam and reject it
        if (Config::get_resp_code($this->site) != 200){
            Response::out('non-200 response');
        }
    }

    function generate_name(){
        $count = 0;
        do {
            $filename = "";
            for ($i = 0; $i < Config::$url_length; $i++){
                $filename .= Config::$usable[array_rand(Config::$usable)];
            }
            // safety net
            $count++;
        } while (in_array($filename, $this->names) && $count < 100);

        $this->short = $filename;
    }

    function store_file(){
        $loc = "files/{$this->short}-{$this->file_name}";
        if ($this->file && move_uploaded_file($this->file['tmp_name'], $loc)){
            return;
        } else if ($this->image_data && file_put_contents($loc, $this->image_data)){
            return;
        }
        Response::out('error saving file');
    }

    function save_file(){
        // twitter iOS client doesn't give name
        if (empty($this->file['name'])){
            if ($this->message){
                $this->file_name = substr(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $this->message)), 0, 15).'.jpg';
            } else {
                $this->file_name = 'uploaded_image.jpg';
            }
        } else {
            $this->file_name = $this->file['name'];
        }

        if (Db::save($this->short, $this->file_name, 0, $this->message)){
            // if iOS client, don't redirect
            if (!$this->message) {
                header("Location: {$this->short}");
            }
        }

        $this->store_file();
    }

    function save_image_data(){
        $this->file_name = 'image_data';
        $this->store_file();

        Db::save($this->short, $this->file_name, 0);
    }
}

/**
 * handle response
 */
$up = new Up();
$up->run();
?>
