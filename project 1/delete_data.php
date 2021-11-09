<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Data</title>
</head>
<body>

	<div class="container">
	
		</div class="header">

			<h2>Delete Data</h2>

		</div>

		<form action="delete_data.php" method="post">

			<div>
				
				<label for="eid">Eid</label>
				<input type="text" name="eid" required> 

			</div>


			<div>
				
				<label for="material_id">Material id</label>
				<input type="text" name="material_id" required> 
				
			</div>


			<button type="submit" name="delete"> Delete </button>

			<p>	<a href="index.php"><b>Return Back</b></a></p>



		</form>

	</div>

</body>
</html>