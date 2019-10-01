<?php
$user = "mmmore_user";
$pass = "2z4cHUttV9>w";

$host = "mongo";
$port = "27017";

$connection = new Mongo('mongodb://'.$user.':'.$pass.'@'.$host.':'.$port);
?>