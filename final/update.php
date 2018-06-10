<?PHP
$data = json_decode(file_get_contents('php://input'));

try {
	$db = new PDO('mysql:host=localhost;dbname=mid;charset=utf8'
		,'d04220208','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	http_response_code(500);
	echo 'failed';
	//echo $err->getMessage(); //測試的時候用
	exit;
}


$stmt = $db->prepare('update messageboard set name=?,message=?,title=? where m_id=?');
$stmt->execute( [ $data->{"nn"},$data->{"mm"}, $data->{"tt"}, $data->{"id"} ] );


http_response_code(200); 
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);            

