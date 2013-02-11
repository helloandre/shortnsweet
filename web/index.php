<?php

require("../lib/sns.php");

try {
    SnS::init();
} catch (Exception $e) {
    Response::fail($e->getMessage());
}

?>