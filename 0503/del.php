<?php
// $HTTP_RAW_POST_DATA �ק�php.ini   702�� ;always_populate_raw_post_data = -1  
//�w�����쪺�榡   {prod:?? ,price:??}
$data = json_decode(file_get_contents('php://input'));

//����
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
	//echo $err->getMessage();  ���ե�
	exit;
}


$stmt = $db->prepare('delete from moneybook where m_id');
$stmt->execute([$data->{"id"}]);

//��X
$data->{"id"} = $db->lastInsertId();  //���o�e�@�� insert �� id

http_response_code(200);
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($data);              //��insert����ƦA�^�ǵ��Τ��