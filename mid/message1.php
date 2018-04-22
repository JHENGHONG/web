<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>留言列表</title>
</head>
<body>

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



echo '<table border=2 width=100%>';  
	echo '<tr>';
	echo '<td></td>';
	echo '<td align=center><a href ="group.html">標題</a></td>';
	echo '<td>名稱</td>';
	echo '</tr>';
while($row = $stmt->fetch()){ 
	echo '<tr>';
	echo "<td>$row[m_id]</td>";
	if(isset($_GET["user"])){
	echo "<td align=center> <a href = content.php?id=$row[m_id]&user=$_GET[user]>$row[title]</a></td>";
	}else{
	echo "<td align=center> <a href = content.php?id=$row[m_id]>$row[title]</a></td>";
	}
	echo "<td>$row[name]</td>";
	echo '</tr>';
}
echo '</table>';

?>
<a href="group.html">群組列表</a>


<form method="POST" action="<?php 
	if(isset($_GET["user"])){
		echo "add.php?user=";
		echo $_GET["user"];
	}else{
		echo "add.php";
	}
	?>
	">
	發表：<input type="text" name="tt">
	<br>
	名稱：<input type="text" name="nn" value=
		<?php
		if(isset($_GET["user"])){
			echo "\"$_GET[user]\" readonly";
		}else{
			echo "\"匿名\" readonly";
		}?>> 
	<br>
	內容：<input type="text" name="mm">
	<input type="submit">
	<br>
	
	
</form>

<hr>


<?php
if(isset($_GET["user"])){
	echo "現在使用者為:<br>";
	echo $_GET['user'];
	echo "<br>";
	echo '<input type="button" value="登出" onclick="location.href=\'message1.php\'">';
	
}else{
echo '<form method="POST" action="signin.php">
	 帳號：<input type="text" name="account">
	 <br>
	 密碼：<input type="password" name="password">
	 <br>
	 <input type="submit" value="登入" >
	 <input type="button" value="註冊" onclick="location.href=\'signupig.php\'">
	 </form>';
}?>

</body>
</html>