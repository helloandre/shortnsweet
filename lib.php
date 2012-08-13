<?php
class Config {

    /*******
     * Google Safebrowsing API key
     * see the README for instructions on how to set this value
     ******/
    static $gsb_key = null;

    /******
     * Basic config
     *****/

    // this is where your url will go (really important)
    // without http://
    static $site_url = "ablu.us";

    // name of your site
    static $site_name = "Ablu.us";

    // if you want to include some kind of analytics (google analytics, mixpanel, piwik, etc), set this staticiable to true:
    static $analytics = false;

    /*******
     * Advanced config
     *******/
    /* this controls how many letters/numbers in the url
     *      for only lowercase alphabet (default as of v1.0):
     *      3 -> 26 ^ 3 = 17576
     *      4 -> 26 ^ 4 = 456976
     * 
     * the higher this number, the longer the url, but also the more you can handle
     */     
    static $url_length = 3;

    // easily expandable to include uppercase and numbers and symbols
    static $usable = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

    /**
     * 
     * DO NOT EDIT BELOW THIS LINE
     *
     */
    static $redirect = false;

    static function set_redirect($redirect){
        self::$redirect = $redirect;
    }

    static function get_resp_code($url){
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch1);
        $resp = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
        curl_close($ch1);
        return $resp;
    }
}

class Response {

    static function out($msg){
        die($msg);
    }

    static function url($short){
        self::out("http://" . Config::$site_url . "/$short");
    }
}

class Db {

    // The database name
    static $db_name = "shorten";

    // this should almost always be localhost
    static $db_host = "localhost";

    // the database user
    static $db_user = "shorten_user";

    // the database password
    static $db_pass = "OnbrchLN";

    function init(){
        if (!mysql_connect(self::$db_host, self::$db_user, self::$db_pass)){
            Ressponse::out('db error ' . mysql_error());
        } else {
            mysql_select_db(self::$db_name);
        }
    }

    function q($query){
        if ($result = mysql_query($query)){
            return $result;
        } else {
            Response::out('database error');
        }
    }

    function save($short, $long, $is_site = 0, $message = ""){
        $params = array(
            'keys' => array(
                '`short`',
                '`long`',
                '`site`',
                '`ip`'
            ),
            'values' => array(
                $short,
                mysql_escape_string($long),
                $is_site,
                0
            )
        );

        if (!empty($message)){
            $params['keys'][] = '`tweet`';
            $params['values'][] = mysql_escape_string($message);
        }

        $query = "INSERT INTO `shorten` (" . implode(',', $params['keys']) . ") VALUES ('" . implode("','", $params['values']) . "')";
        return self::q($query);
    }
}

class View {
    var $name = '';
    var $long = '';
    var $short = '';
    var $is_site = false;
    var $is_mobile = false;
    var $found = false;

    function __construct($short){
        
        if (!($result = Db::q("SELECT * FROM `shorten` WHERE `short`='" . mysql_escape_string($short) . "'"))) {
            return;
        }
        $this->found = true;

        $data = mysql_fetch_assoc($result);
        $this->long = $data['long'];
        $this->short = $data['short'];
        $this->is_site = (bool)$data['site'];

        // insert @ mentions
        $this->message = preg_replace('/\@([a-z0-9]+)/i', '@<a href="http://twitter.com/$1">$1</a>', $data['tweet']);

        $this->name = $this->short . '-' . htmlspecialchars($this->long);

        $ua =$_SERVER['HTTP_USER_AGENT'];
        $this->is_mobile = (stripos($ua, 'iphone') || stripos($ua, 'blackberry') || stripos($ua, 'android'));
    }
}
?>
