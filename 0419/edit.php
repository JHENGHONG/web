<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>輸入</title>
</head>
<body>
<?php
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

$stmt = $db->prepare('select * from moneybook where m_id=?');
$stmt->execute([$_GET['id']]);

$row = $stmt->fetch();
if( !$row ){
	echo '資料不存在';
	echo '<"a href="list.php"回到列表"/a"';
	exit;
}
?>


<form method="POST" action="update.php">
	<input type="hidden" name="id" value="<?php echo $row["m_id"]?>" >
	請輸入商品：<input type="text" name="prod" value="<?php echo $row["name"]?>" >
	金額：<input type="text" name="price" value="<?php echo $row["cost"]?>" >
	<input type="submit"> <a href="list.php">取消</a>
</form>





</body>
</html>