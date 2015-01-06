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

	function createPage($name,$link,$qnumb,$anumb){
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
				<title>$name</title>
				<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css\">
				<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.2.min.js'></script>
				</head>";
		$page = $page."<body>";
		$page = $page."<div class='container'> <h3>Quesion's List can be downloaded <a href='$link'>here</a>. </h3> </div>";
		$page = $page.'<div class=\'container\'>
		<form role=\'form\' action=\'save.php\' method=\'post\'>
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
							<th><input type=\'radio\' name=\'<?php echo $j;?>\' value=\'<?php echo $k;?>\' required=\'true\'></th>						
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
							<th><input type=\'radio\' name=\'<?php echo $j;?>\' value=\'<?php echo $k;?>\' required=\'true\'></th>						
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
		</form>
	</div>';
		$page = $page."</body>";
		$page = $page."</html>";
		return $page;
	}

?>