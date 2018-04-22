<?php
if( !isset($_POST['tt']) 
	|| !isset($_POST['mm'])
	|| empty($_POST['tt'])  
	|| empty($_POST['mm']) )
{
	echo '不對';
	echo '<a href="message1.php">回到列表</a>';
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
	echo '<a href="message1.php">回到列表</a>';
	exit;
}



$stmt = $db->prepare('insert into messageboard (title,name,message) values (?,?,?)');
$stmt->execute([$_POST['tt'],$_POST['nn'],$_POST['mm']]);

if(isset($_GET["user"])){
$u =$_GET["user"];
header("Location: message1.php?user=$u"); 
}else{
header("Location: message1.php"); 	
}
