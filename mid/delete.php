<?php
if( !isset($_GET['id']) || empty($_GET['id']) )
{
	echo '不對';
	echo '<a href="list.php">回到列表</a>';
	exit;
}

try {
	$db = new PDO('mysql:host=localhost;dbname=mid;charset=utf8'
		,'d04220208','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	echo '<a href="list.php">回到列表</a>';
	exit;
}


$stmt = $db->prepare('delete from messageboard where m_id=?');
$stmt->execute([$_GET['id']]);

header('Location: list.php',TRUE,303);  //沒寫,TRUE,333也可以，但是..
