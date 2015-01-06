<?php
	require "general.php";
	if(!(isset($_POST['name']) && isset($_FILES['document']) && isset($_POST['question']) && isset($_POST['answer']))){
		header('Location : home.php');
		exit;
	}
		if(pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION)!="pdf")
			header('Location : home.php');

		$i = 0;
		while(file_exists("soal/$i-{$_FILES['document']["name"]}")){
			$i++;
		}
		move_uploaded_file ($_FILES['document'] ['tmp_name'],
   		"soal/$i-{$_FILES['document'] ['name']}");

		connectDatabase();
		$document = "soal/$i-{$_FILES['document'] ['name']}";
		$name = naming($_POST['name']);		
		$db_ans = "db_".$name;
		$name = $name.".php";
		$qnumb = $_POST['question'];
		$anumb = $_POST['answer'];
		setcookie("qnumb",$qnumb);
		setcookie("db_ans",$db_ans);
		$query ="CREATE TABLE IF NOT EXISTS `$db_ans` (
				`no` INT AUTO_INCREMENT ,
				`answer` VARCHAR(1) NOT NULL, PRIMARY KEY (`no`)
			);";
		//echo $query;
		$result = mysql_query($query);
		if(!$result){
			header('Location : home.php');
			exit;
		} 
		$query = "INSERT INTO `document`(`name`,`src`,`qnumb`,`anumb`,`db_ans`) VALUES('$name','$document',$qnumb,$anumb,'$db_ans');";
		//echo $query;
		$result = mysql_query($query);
		if(!$result){
			header('Location : home.php');
			exit;
		}
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

?>
	<html>
	<?php getHead(); ?>
	<body>
	<div class="container">
		<form role="form" action="save.php" method="post">
			<div class="row">

				<div class="col-md-6">
					<div class='table-responsive'>
						<table class='table'>
						<thead>
						<th>No.</th>
						<?php
							$k='a';
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
									echo "<tr>";
							?>
							
							<th><label><?php echo $j;?></label></th>
							<?php 
									$k ='a';
									while($k<=$car){
							?>
							<th><input type='radio' name='<?php echo $j;?>' value='<?php echo $k;?>' required='true'></th>						
							<?php

									$k++;
									}
								echo "</tr>";
								$j++;	
								}
							?>

						</tbody>
						</table>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class='table-responsive'>
						<table class='table'>
						<thead>
						<th>No.</th>
						<?php
							$k='a';
							while($k<=$car){
								echo "<th>$k</th>";
								$k++;
							}
						?>
						</thead>
						<tbody>
							<?php
								while($j<=$qnumb){
									echo "<tr>";
							?>
							
							<th><label><?php echo $j;?></label></th>
							<?php 
									$k ='a';
									while($k<=$car){
							?>
							<th><input type='radio' name='<?php echo $j;?>' value='<?php echo $k;?>' required='true'></th>						
							<?php

									$k++;
									}
								echo "</tr>";
								$j++;	
								}
							?>

						</tbody>
						</table>
					</div>
				</div>

				<input type='submit' value='Submit'/>
			</div>
		</form>
	</div>




	</body>
	</html>