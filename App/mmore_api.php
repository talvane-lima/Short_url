<?php

/*
	Insert a new document in mongoDB
	$user_id: User ID
	$urls: Original url to create a tiny url

	return: The new document inserted on mongoDB
*/
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

    $urls->insert($insert_data);

    return $insert_data;
}


/*
	Find document ($short_url) on mongoDB
	$short_url: Short url to find on mongoDB

	return: The document content $short_url
*/
function find_url($short_url)
{	
	include 'connect_mongo.php';
	$short_url_db = $connection->selectDB('short_url_db');
	$urls = $short_url_db->selectCollection('urls');

	$find_data = array(
		'short_url' => $short_url
	);

	$result = $urls->findOne($find_data);
	$urls->update($find_data, array('$set' => array('number_clicks' => $result['number_clicks']+1)));
	$result = $urls->findOne($find_data);

    return $result;
}

echo json_encode(find_url("https://mmore/479e071c"));
?>