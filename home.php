<html>
	<?php
		require "general.php";
		if(!isLogin()){
			goHome();
		}
		getHead();
	?>
	<body>
		<?php getBodyHeader();?>
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
					<h3>Upload File</h3>
					<form role="form" action="answer.php" method="post" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="name">Quiz name:</label>
						    <input type="name" class="form-control" id="name" name="name" required="true">
						  </div>
						  <div class="form-group">
						    <label for="document">Question Document (in pdf):</label>
						    <input type="file" class="form-control" style="min-height : 20px;" id="document" name="document" placeholder="Browse .pdf" required="true">
						  </div>
						  <div class="form-group">
						    <label>Question number: </label>
						    <input type="number" id="question" name="question" min="1" value="1" required="true"> 
						  </div>
						  <div class="form-group">
						    <label>Answer number: </label>
						    <input type="number" id="answer" name="answer" min="3" max="5" value="3" required="true"> 
						  </div>
						  <button type="submit" class="btn btn-default">Submit</button>
					</form>
			</div>
			<div class="col-md-3">
			</div>
			
		</div>
		<?php getBodyFooter();?>
	</body>

</html>