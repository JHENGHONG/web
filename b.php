<?php
 
 $W = "預設值";
 
 if ( !isset($_GET['QQ']) || !is_numeric($_GET['QQ']) ){
	echo "錯誤參數";
 }else{
	$W = $_GET['QQ'];
	echo $W;
 }
