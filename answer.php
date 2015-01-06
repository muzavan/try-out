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

		$document = "soal/$i-{$_FILES['document'] ['name']}";
		$name = naming($_POST['name']);		
		$db_ans = "db_".$name;
		$name = $name.".php";
		$qnumb = $_POST['question'];
		$anumb = $_POST['answer'];
		$query ="CREATE TABLE `$db_ans` IF NOT EXISTS (
				`no` INT AUTO_INCREMENT NOT NULL,
				`answer` VARCHAR(1) NOT NULL
			);";
		$result = mysql_query($query);
		if(!$result){
			header('Location : home.php');
		} 
		$query = "INSERT INTO `document`(`name`,`document`,`qnumb`,`anumb`,`db_ans`) VALUES('$name','$document',$qnumb,$anumb,'$db_ans');";
		
		$result = mysql_query($query);
		if(!$result){
			header('Location : home.php');
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
					<?php
						$j=1;
						while($j<=$qnumb/2){
					?>
					<label><?php echo $j;?></label>
					<?php 
							$k ='a';
							while($k<=$car){
					?>
					<input type='radio' name='<?php echo $j;?>' value='<?php echo $k;?>'>						
					<?php

							$k++;
							}
						echo "<br/>";
						$j++;	
						}
					?>
				</div>
				<div class="col-md-6">
					<?php
						while($j<=$qnumb){
					?>
					<label><?php echo $j;?></label>
					<?php 
							$k ='a';
							while($k<=$car){
					?>
					<input type='radio' name='<?php echo $j;?>' value='<?php echo $k;?>'>						
					<?php
							$k++;
							}
						echo "<br/>";
						$j++;	
						}
					?>
				</div>
				<input type='submit' value='Submit'/>
			</div>
		</form>
	</div>




	</body>
	</html>