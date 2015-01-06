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

	function createPage($name,$realName,$link,$qnumb,$anumb,$db_ans,$db_has){
		$car = 'c';
		switch($anumb){
			case 3 :
				$car = 'c';
				break;
			case 4 :
				$car = 'd';
				break;
			case 5 :
				$car = 'e';
				break;
		}

		$page ='<?php $car=\''.$car.'\';'.'$qnumb='.$qnumb.';'.'?>';
		$page = $page."<html>";
		$page = $page."<head>
				<!-- Latest compiled and minified CSS -->
				<title>".$name."</title>
				<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css\">
				<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.2.min.js'></script>
				</head>";
		$page = $page."<body>";
		$page = $page."<div class='container'><h1>Try Out : $name</h1> <h3>Quesion's List can be downloaded <a href='$link'>here</a>. </h3> </div>";
		$page = $page.'
		<form role=\'form\' action=\'finish-'.$realName.'\' method=\'post\'>	
			<div class=\'container\'>
				<label>Name</label>
				<input type="text" name="name" required="true" />
				<label>ID (optional)</label>
				<input type="text" name="id" placeholder="Institution, class, or ID-Number" />	
			</div>
			<div class=\'container\'>
			<div class=\'row\'>

				<div class=\'col-md-6\'>
					<div class=\'table-responsive\'>
						<table class=\'table\'>
						<thead>
						<th>No.</th>
						<?php
							$k=\'a\';
							while($k<=$car){
								echo "<th>$k</th>";
								$k++;
							}
						?>
						</thead>
						<tbody>
							<?php
								$j=1;
								while($j<=$qnumb/2){
									echo \'<tr>\';
							?>
							
							<th><label><?php echo $j;?></label></th>
							<?php 
									$k =\'a\';
									while($k<=$car){
							?>
							<th><input type=\'radio\' name=\'<?php echo $j;?>\' value=\'<?php echo $k;?>\'></th>						
							<?php

									$k++;
									}
								echo \'</tr>\';
								$j++;	
								}
							?>

						</tbody>
						</table>
					</div>
				</div>
				
				<div class=\'col-md-6\'>
					<div class=\'table-responsive\'>
						<table class=\'table\'>
						<thead>
						<th>No.</th>
						<?php
							$k=\'a\';
							while($k<=$car){
								echo "<th>$k</th>";
								$k++;
							}
						?>
						</thead>
						<tbody>
							<?php
								while($j<=$qnumb){
									echo \'<tr>\';
							?>
							
							<th><label><?php echo $j;?></label></th>
							<?php 
									$k =\'a\';
									while($k<=$car){
							?>
							<th><input type=\'radio\' name=\'<?php echo $j;?>\' value=\'<?php echo $k;?>\' ></th>						
							<?php

									$k++;
									}
								echo \'</tr>\';
								$j++;	
								}
							?>

						</tbody>
						</table>
					</div>
				</div>

				<input type=\'submit\' value=\'Submit\'/>
			</div>
	</div>
	</form>	';
		$page = $page."</body>";
		$page = $page."</html>";
		$myfile = fopen($realName, "w") or die("Unable to open file!");
		fwrite($myfile, $page);
		fclose($myfile);

		$finish = '
			<?php
	require "general.php";
	connectDatabase();
	$ID = \'No ID\';
	if(isset($_POST[\'id\'])){
		$ID = $_POST[\'id\'];
	}

	$name = $_POST[\'name\'];
	$query = "SELECT * FROM `'.$db_ans.'` ORDER BY `no`;";
	$result = mysql_query($query);
	$i=1;
	$skor = 0;
	while($hsl = mysql_fetch_assoc($result)){
		if(!isset($_POST[$i])){
			$skor+=0;
		}
		else{
			if($_POST[$i]==$hsl[\'answer\']){
				$skor+=4;
			}
			else{
				$skor-=1;
			}
		}
		$i++;
	}

	$query = "INSERT INTO `'.$db_has.'`(`name`,`id`,`skor`) VALUES(\'$name\',\'$ID\',$skor);";
	$result = mysql_query($query);
	if($result){
		echo "<h2>Your score is $skor. See other\'s via <a href=\'result-'.$realName.'\'>here</a></h2>";
	}
?>
		';
		$myfile = fopen("finish-".$realName, "w") or die("Unable to open file!");
		fwrite($myfile, $finish);
		fclose($myfile);

		$result ='

<html>
<head>
				<!-- Latest compiled and minified CSS -->
				<title>'.$name.'</title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
				<script type=\'text/javascript\' src=\'https://code.jquery.com/jquery-1.11.2.min.js\'></script>
</head>
<body>
	<div class="container">
	<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
	<h3>Results from '.$name.' </h3>
	</div>
	<div class="col-md-3">
	</div>
	</div>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
		<div class="table-responsive">
		<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>ID</th>
			<th>Score</th>
		</thead>
		<tbody>
			<?php
				require "general.php";
				connectDatabase();
				$query = "SELECT * FROM `'.$db_has.'` ORDER BY `skor` DESC;";
				$result = mysql_query($query);
				$i=1;
				while($hsl = mysql_fetch_assoc($result)){
			?>
			<tr>
			<th> <?php echo $i;?> </th>
			<th> <?php echo $hsl[\'name\'];?> </th>
			<th> <?php echo $hsl[\'id\'];?> </th>
			<th> <?php echo $hsl[\'skor\'];?> </th>
			</tr>
			<?php
					$i++;
				}
			?>
		</tbody>
		</table>
		</div>
		</div>
		<div class="col-md-3">
		</div>
	</div>
	</div>
</body>
</html>
		';
		$myfile = fopen("result-".$realName, "w") or die("Unable to open file!");
		fwrite($myfile, $result);
		fclose($myfile);
	}


?>