<?php

class View {
    static $long;
    static $short;
    static $date;
    static $url;
    static $name = "Not Found";
    static $template = "../web/view.php";
    static $base = "file/";
    
    static private $type;
    static private $found = false;

    public function run() {
        self::fetch();
        
        // if they're not running any kind of js analytics, redirect immediately
        if (self::is_url() && !Config::$analytics) {
            Response::redirect(self::$long);
        }
        
        self::$url = SnS::make_url(self::url());
        
        return self::$template;
    }
    
    private function fetch() {
        self::$short = mysql_escape_string(trim($_GET['upload'], "/"));
        
        $query = "SELECT * FROM `" . Config::$db_table . "` WHERE `short`='" . self::$short . "' LIMIT 1";
        $result = Db::q($query);
        
        if ($row = mysql_fetch_assoc($result)) {
            self::$found = true;
            
            self::$name = $row['name'];
            self::$long = $row['long'];
            self::$type = $row['type'];
            self::$date = date("m/d/y", strtotime($row['ts']));
        }
    }
    
    private function url() {
        return self::$base . self::$short . "-" . self::$long;
    }
    
    public function is_url() {
        return self::$type == SNS_TYPE_URL;
    }
    
    public function found() {
        return self::$found;
    }
}

?>
