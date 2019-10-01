<?php

function insert_mongo($user_id, $url)
{	
	include 'connect_mongo.php';
	$short_url_db = $connection->selectDB('short_url_db');
	$urls = $short_url_db->selectCollection('urls');

	$base_new_url = 'https://mmore/';
	$new_url = hash('Adler32', $url);

	$insert_data = array(
		'user_id' => $user_id,
		'original_url' => $url,
		'short_url' => $base_new_url.$new_url,
		'saved_at' => new MongoDate(),
		'number_clicks' => 0
	);

    $result = $urls->insert($insert_data);
    return $result;
}

echo var_dump(insert_mongo("mm001", "https://www.uol.com"));
?>