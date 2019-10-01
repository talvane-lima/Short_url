<?php
require_once 'connect_mongo.php';

$db = $mongo->short_url_db;
$col = $db->urls;
$total = $col->count();
echo $total;
?>