<?php
	
	if(!isset($_POST['name']) || !isset($_POST['password'])){
		die();
	}
	$name = $_POST['name'];
	$password = $_POST['password'];
	$remember="";
	if(isset($_POST['remember'])){
		$remember=$_POST['remember'];
	}
	var_dump($_POST);
	mysql_connect('localhost','root','');
	mysql_select_db('try-out');
	$query = "SELECT * FROM `users` WHERE `username`=\"$name\"";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	if($password===$row['password']){
		if($remember==="on"){
			setcookie("uid",$row['ID'],time()+86400*7);
		}
		else{
			setcookie("uid",$row['ID'],0);
		}
		echo "Login berhasil. Klik <a href='admin-post.php'> ini </a> jika tidak automatis redirect";
		header('HTTP/1.0 302 Found');
		header('Location: http://localhost/try-out/home.php');
		exit;
	}
	else{
		echo "Login gagal. Username dan password tidak cocok";
	}
?>