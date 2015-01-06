<?php
	function getHead(){
		echo "<head>
				<!-- Latest compiled and minified CSS -->
				<title>Try Out Generator</title>
				<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css\">
				<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.2.min.js'></script>
				</head>";
	}

	function isLogin(){
		return (isset($_COOKIE['uid']));
	}

	function goHome(){
			header('HTTP/1.0 302 Found');
			header('Location: login.php');
			exit;
	}

	function getBodyFooter(){
		echo "<div class='container' style='color:#fff;background-color:#000;width:100%;'> Created by <a href='http://github.com/muzavan' >muzavan</a></div>";
	}

	function getBodyHeader(){
		echo "<div class='container' style='background-color:#0d0d0d;text-color:#ffffff;padding:10px 0 10px 0;width:100%;'> <h2 style='color:#fff;'>Try-Out Generator</h2> </div>";
	}

	function connectDatabase(){
		mysql_connect('localhost','root','');
		mysql_select_db('try-out');
	}

	function naming($str){
		$str = strtolower($str);
		$str = str_replace(" ", "-", $str);
		return $str;
	}

?>