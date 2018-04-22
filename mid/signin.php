<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>輸入</title>
</head>
<body>
<?php




if( !isset($_POST['account']) 	|| empty($_POST['account']) 
	|| !isset($_POST['password']) || empty($_POST['password'])){
		if($_POST['account'] == "root"){
			echo '<a href="list.php">刪除文章</a>';
		}else{
		echo '輸入不完整';
		echo '<a href="message1.php">上一頁</a>';
		exit;
		}
}else{

	try {
		$db = new PDO('mysql:host=localhost;dbname=mid;charset=utf8'
		,'d04220208','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
		}catch(PDOException $err) {
		echo "ERROR:";
		echo $err->getMessage();  //真實世界不這樣做
		echo '<a href="content.php">回到列表</a>';
		exit;
	}

	$stmt = $db->prepare('select * from user');
	$stmt->execute();
	while($row = $stmt->fetch()){
		if($_POST['account']==$row['account']&&$_POST['password']==$row['password']){
			$user=$row['username'];
			header("location:message1.php?user=".$user);
		}else{
			echo '輸入錯誤';
		}	
	}	
}



?>

</body>
</html>