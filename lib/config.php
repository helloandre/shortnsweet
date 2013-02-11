<?php

class Config {
    /******
     *
     *
     * Required Config
     *
     *
     *****/

    // this is where your url will go (really important)
    // without http://
    static $site_url = "localhost/shortnsweet";

    // name of your site
    static $site_name = "Ablu.us";

    // if you want to include some kind of analytics (google analytics, mixpanel, piwik, etc), set this staticiable to true:
    static $analytics = false;
    
    /**
     * database
     */
    // The database name
    static $db_name = "shortnsweet";

    // this should almost always be localhost
    static $db_host = "localhost";

    // the database user
    static $db_user = "shortnsweet";

    // the database password
    static $db_pass = "shortpass";
    
    // the database table
    static $db_table = "upload";
    
    /******
     *
     *
     * Optional Config
     *
     *
     *****/

    /*******
     * Google Safebrowsing API key
     * see the README for instructions on how to set this value
     ******/
    static $gsb_key = null;
    
    /******
     *
     *
     * Advanced Config
     *
     *
     *****/
    
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
}

?>
