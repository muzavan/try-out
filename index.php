<?php
	$loc = "";
	if(isset($_COOKIE['uid'])){
		$loc="home.php";
	}
	else{
		$loc="login.php";
	}
	header('Location:'.$loc);
?>