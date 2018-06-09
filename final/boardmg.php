<?php

$id = $_GET['id'];

try {
	$db = new PDO('mysql:host=localhost;dbname=mid;charset=utf8'
		,'d04220208','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	http_response_code(500);
	echo 'failed';
	exit;
}

$stmt = $db->prepare('select * from message where choose=?');
$stmt->execute([$id]);

$data = array();

while($row = $stmt->fetch()){  
	$data[] = (object)[
			'mgname' => $row['name'],
			'mgmessage' => $row['message'],
			'mgid' => $row['m_id']
		];
}



http_response_code(200);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);            