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
	if ($urls->count(array('user_id' => $user_id,'original_url' => $url))>=1) {
    	echo json_encode($urls->findOne(array('user_id' => $user_id,'original_url' => $url)));
	} else {
		$urls->insert($insert_data);
    	echo json_encode($insert_data);
	}
	$connection->close();
}


/*
	Find document ($short_url) in mongoDB
	$short_url: Short url to find in mongoDB

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
	$connection->close();
    echo json_encode($result);
}


/*
	Find document ($user_id) in mongoDB
	$user_id: User ID

	return: All documents content $user_id
*/
function find_for_user($user_id)
{	
	include 'connect_mongo.php';
	$short_url_db = $connection->selectDB('short_url_db');
	$urls = $short_url_db->selectCollection('urls');

	$find_data = array(
		'user_id' => $user_id
	);

 
	if ($urls->count($find_data) > 1) {
		$result = $urls->find($find_data);
		foreach ($result as $key => $value) {
 			echo json_encode($value);
		}
	} else {
		$result = $urls->findOne($find_data);
		echo json_encode($result);
	}
	
	$connection->close();
    
}

if(isset($_GET['user_id']) && isset($_GET['url'])) {
    insert_mongo($_GET['user_id'],$_GET['url']);
}
else{
	if (isset($_GET['user_id'])) {
		find_for_user($_GET['user_id']);
	}
	if (isset($_GET['url'])) {
		find_url($_GET['url']);
	}
} 


?>