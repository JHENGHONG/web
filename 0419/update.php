<?php
if(	!isset($_POST['id'])
	||!isset($_POST['prod']) || !isset($_POST['price'])
	|| empty($_POST['price']) 
	|| empty($_POST['prod']) )
{
	echo '不對';
	echo '<a href="list.php">回到列表</a>';
	exit;
}

//$db = new PDO('連線字串',帳號,密碼,額外參數);
//$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
//	,'mememe','123456' );
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	echo '<a href="list.php">回到列表</a>';
	exit;
}

//echo "連線成功";

$stmt = $db->prepare('update moneybook set name=?,cost=? where m_id=?');
$stmt->execute([$_POST['prod'],$_POST['price'],$_POST['id']]);

//echo '新增了';
//echo $stmt->rowCount();
//echo '筆資料';

header('Location: list.php',TRUE,303);  //沒寫,TRUE,333也可以，但是..
