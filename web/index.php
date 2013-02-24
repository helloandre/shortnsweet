<?php

require("../lib/sns.php");

try {
    SnS::init();
    SnS::run();
} catch (Exception $e) {
    Response::fail($e->getMessage(), $e->getHTTPCode());
}

?>