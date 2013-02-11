<?php

class Db {

    static function init(){
        if (!mysql_connect(Config::$db_host, Config::$db_user, Config::$db_pass)){
            Response::out('db error ' . mysql_error());
        } else {
            mysql_select_db(Config::$db_name);
        }
    }

    static function q($query){
        if ($result = mysql_query($query)){
            return $result;
        } else {
            throw new Error_Database('database error');
        }
    }
}

?>
