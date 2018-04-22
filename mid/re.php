<?php
if( !isset($_POST['nnn']) 
	|| !isset($_POST['rrr'])
	|| empty($_POST['nnn'])  
	|| empty($_POST['rrr']) )
{
	echo '填寫內容';
	if(isset($_GET["user"])){;
	echo "<a href=\"content.php?id=$_GET[id]&user=$_GET[user]\">回到列表</a>";
	}else{
	echo "<a href=\"content.php?id=$_GET[id]\">回到列表</a>";
}
	
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


$stmt = $db->prepare('insert into message (name,message,choose) values (?,?,?)');
$stmt->execute([$_POST['nnn'],$_POST['rrr'],$_POST['ccc']]);



if(isset($_GET["user"])){;
	header("Location:content.php?id=$_GET[id]&user=$_GET[user]");
	}else{
	header("Location:content.php?id=$_GET[id]");
}



