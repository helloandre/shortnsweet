<?php

class Object {
    
    var $short;
    var $long;
    var $type;
    var $name = null;
    
    function __construct() {
        $this->generate_short();
    }
    
    /**
     * WARNING!!
     * This is a really bad way to do this
     * SQL call in a loop? 0xbad1dea
     */
    protected function generate_short() {
        do {
            $short = "";
            for ($i = 0; $i < Config::$url_length; $i++){
                $short .= Config::$usable[array_rand(Config::$usable)];
            }
        } while ($this->_short_exists($short));

        $this->short = $short;
    }
    
    private function _short_exists($short) {
        $result = Db::q("SELECT `id` FROM `" . Config::$db_table . "` WHERE `short`='" . mysql_escape_string($short) . "'");
        return mysql_fetch_array($result);
    }
    
    public function save() {
        $params = array(
            'keys' => array(
                '`short`',
                '`long`',
                '`type`',
                '`name`'
            ),
            'values' => array(
                mysql_escape_string($this->short),
                mysql_escape_string($this->long),
                $this->type,
                $this->name
            )
        );

        $query = "INSERT INTO `" . Config::$db_table . "` (" . implode(',', $params['keys']) . ") VALUES ('" . implode("','", $params['values']) . "')";
        return Db::q($query);
    }
}

?>