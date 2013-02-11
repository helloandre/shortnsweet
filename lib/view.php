<?php

class View {
    static $long;
    static $short;
    static $date;
    static $url;
    static $name = "Not Found";
    
    static private $type;
    static private $found = false;

    public function init() {
        self::fetch();
        
        // if they're not running any kind of js analytics, redirect immediately
        if (self::is_url() && !Config::$analytics) {
            Response::redirect(self::$long);
        }
        
        self::$url = SnS::make_url("file/" . self::$short . "-" . self::$long);
    }
    
    private function fetch() {
        self::$short = mysql_escape_string($_GET['upload']);
        
        $query = "SELECT * FROM `" . Config::$db_table . "` WHERE `short`='" . self::$short . "'";

        if ($result = Db::q($query)) {
            self::$found = true;
            
            $row = mysql_fetch_assoc($result);
            self::$name = $row['name'];
            self::$long = $row['long'];
            self::$type = $row['type'];
            self::$date = date("m/d/y", strtotime($row['ts']));
        }
    }
    
    public function is_url() {
        return self::$type == SNS_TYPE_URL;
    }
    
    public function found() {
        return self::$found;
    }
}

?>
