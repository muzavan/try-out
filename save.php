<?php
	require "general.php";
	$no = 1;
	$max = intval($_COOKIE['qnumb']);
	$db_ans = $_COOKIE['db_ans'];
	connectDatabase();
	while($no <= $max){
		$ans = $_POST[$no];
		//echo $ans."<br/>";
		$query = "INSERT IGNORE INTO `$db_ans`(`no`,`answer`) VALUES($no,'$ans');";
		mysql_query($query);
		$no++;
	}
	$link = $_COOKIE['link'];
	echo "Try Out has been created. Try Out can be accessed via this <a href=\"$link\">link</a>";
?>