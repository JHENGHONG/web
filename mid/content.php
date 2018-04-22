<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>輸入</title>
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

$stmt = $db->prepare('select * from messageboard where m_id=?');
$stmt->execute([$_GET['id']]);

$row = $stmt->fetch();
if( !$row ){
	echo '資料不存在';
	exit;
}

echo '<h4>';
echo "作者： $row[name]";
echo '<h4>';


echo '<h4>';
echo "標題： $row[title]";
echo '</h4>';


 
echo '<h1>';
echo $row["message"];
echo '<br>'; 
echo '</h1>';

	
echo '<hr>';


$stmt = $db->prepare('select* from message where choose=?');
$stmt->execute([$_GET['id']]);
while($row = $stmt->fetch()){
echo "<h3>$row[name]：$row[message]</h3>";

}

echo '<hr>';	

$stmt = $db->prepare('select * from messageboard where m_id=?');
$stmt->execute([$_GET['id']]);
$row = $stmt->fetch();

if(isset($_GET["user"])){
	echo "<a href=message1.php?id=$row[m_id]&user=$_GET[user]>返回</a>";
	}else{
	echo "<a href=message1.php?id=$row[m_id]>返回</a>";
}
?>


<form method="POST" action="re.php?<?php if(isset($_GET["user"])){echo "id=$row[m_id]&user=$_GET[user]";}else{echo "id=$row[m_id]";}?>">
	<?php
	if(isset($_GET["user"])){

	echo "名稱<input type=\"text\" name=\"nnn\" value=\"$_GET[user]\" readonly>";
	}else{
	echo '名稱<input type="text" name="nnn" value="匿名" readonly>';
	}
	?>
	回覆：<input type="text" name="rrr">
	<input type="hidden" name="ccc" value="<?php echo $row["m_id"]?>" >
	<input type="submit"> 
</form>

</body>
</html>