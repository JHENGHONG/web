<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>留言</title>
</head>
<body>

<a href="message1.php">回留言列表1</a>
<?php

try {
	$db = new PDO('mysql:host=localhost;dbname=mid;charset=utf8'
		,'d04220208','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	exit;
}

$stmt = $db->prepare('select * from messageboard');
$stmt->execute();



echo '<table border=1>';  //border=1 事後請改用CSS處理
while($row = $stmt->fetch()){  //小心,此處的=號是把右邊的值存往左側
	echo '<tr>';
	echo '<td>'.$row['title'].'</td>';
	echo '<td>'.$row['name'].'</td>';
	echo '<td>'.$row['message'].'</td>';
	echo '<td>';
	echo '<a href="delete.php?id='.$row['m_id'].'">刪除</a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
?>
</body>
</html>