<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert Data</title>
</head>
<body>

	<div class="container">
	
		</div class="header">

			<h2>Insert Data</h2>

		</div>

		<form action="insert_data.php" method="post">

			<div>
				
				<label for="eid">Eid</label>
				<input type="text" name="eid" required> 

			</div>


			<div>
				
				<label for="material_name">Material name</label>
				<input type="text" name="material_name" required> 
				
			</div>

			<div>
				
				<label for="material_id">Material id</label>
				<input type="text" name="material_id" required> 
				
			</div>

			<div>
				
				<label for="minimum_quantity">Minimum quantity</label>
				<input type="text" name="minimum_quantity" required> 
				
			</div>

			<div>
				
				<label for="present_quantity">Present quantity</label>
				<input type="text" name="present_quantity" required> 
				
			</div>


			<button type="submit" name="insert"> Insert </button>

			<p>	<a href="index.php"><b>Return Back</b></a></p>



		</form>

	</div>

</body>
</html>