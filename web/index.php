<?php

require("../lib/SnS.php");

try {
    SnS::init();
} catch (Exception $e) {
    Response::fail($e->getMessage());
}

?>