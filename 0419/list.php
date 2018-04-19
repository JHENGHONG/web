<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>列表</title>
</head>
<body>

<a href="add_form.html">新增</a>
<?php
//連接資料庫
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	exit;
}

//查詢
//等同 $stmt = $db->query('select * from moneybook');
$stmt = $db->prepare('select * from moneybook');
$stmt->execute();

echo '<table border=1>';  //border=1 事後請改用CSS處理
while($row = $stmt->fetch()){  //小心,此處的=號是把右邊的值存往左側
	echo '<tr>';
	//echo '<td>'.$row['m_id'].'</td>';
	echo '<td>'.$row['name'].'</td>';
	echo '<td>'.$row['cost'].'</td>';
	echo '<td>';
	echo '<a href="edit.php?id='.$row['m_id'].'">修改</a> | ';
	echo '<a href="delete.php?id='.$row['m_id'].'">刪除</a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
?>
</body>
</html>