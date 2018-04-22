<?php
if( !isset($_POST['at']) 	|| empty($_POST['at']) 
	|| !isset($_POST['pd']) || empty($_POST['pd']) 
	|| !isset($_POST['ne'])	|| empty($_POST['ne']))
{
	echo '輸入不完整';
	echo '<a href="signupig.php">上一頁</a>';
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
	exit;
}

$stmt = $db->prepare('select * from user');
$stmt->execute();
while($row = $stmt->fetch()){
	if($_POST['ne']==$row['username']||$_POST['at']==$row['account']){
		echo "帳號或名稱重複";
		exit;
	}
	
}	

$stmt = $db->prepare('insert into user (username,account,password) values (?,?,?)');
$stmt->execute([$_POST['ne'],$_POST['at'],$_POST['pd']]);

echo "註冊成功<br>";
echo "<a href=\"message1.php\">回列表</a>";