<?php
// $HTTP_RAW_POST_DATA 修改php.ini   702行 ;always_populate_raw_post_data = -1  
//預期收到的格式   {prod:?? ,price:??}
$data = json_decode(file_get_contents('php://input'));

//測試
//echo $data->{"prod"};
//echo $data->{"price"};


try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {

	http_response_code(500);
	echo 'filed';
	//echo $err->getMessage();  測試用
	exit;
}


$stmt = $db->prepare('delete from moneybook where m_id');
$stmt->execute([$data->{"id"}]);

//輸出
$data->{"id"} = $db->lastInsertId();  //取得前一次 insert 的 id

http_response_code(200);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //把insert的資料再回傳給用戶端