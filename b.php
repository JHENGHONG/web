<?php
 
 $W = "�w�]��";
 
 if ( !isset($_GET['QQ']) || !is_numeric($_GET['QQ']) ){
	echo "���~�Ѽ�";
 }else{
	$W = $_GET['QQ'];
	echo $W;
 }
