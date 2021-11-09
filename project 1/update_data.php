<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Data</title>
</head>
<body>

	<div class="container">
	
		</div class="header">

			<h2>Update Data</h2>

		</div>

		<form action="update_data.php" method="post">

			<div>
				
				<label for="eid">Eid</label>
				<input type="text" name="eid" required> 

			</div>


			<div>
				
				<label for="material_id">Material id</label>
				<input type="text" name="material_id" required> 
				
			</div>


			<div>
				
				<label for="present_quantity">Present quantity</label>
				<input type="text" name="present_quantity" required> 
				
			</div>


			<button type="submit" name="update"> update </button>

			<p>	<a href="index.php"><b>Return Back</b></a></p>



		</form>

	</div>

</body>
</html>