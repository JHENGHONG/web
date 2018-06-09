<?php
$data = json_decode(file_get_contents('php://input'));
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

$stmt = $db->prepare('insert into message (name,message,choose) values (?,?,?)');
$stmt->execute([$data->{"mgname"},$data->{"mgmessage"},$data->{'choose'}]);

//$data->{"id"} = $db->lastInsertId();  

http_response_code(201);
header("Content-type: application/json;charset=UTF-8");
echo json_encode($data);
