<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'users');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query) or die(mysqli_error($db));
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combin ation");
  	}
  }
}


//insert data into db
if (isset($_POST['insert'])) {

	$eid = mysqli_real_escape_string($db, $_POST['eid']);
	$material_name = mysqli_real_escape_string($db, $_POST['material_name']);
	$material_id = mysqli_real_escape_string($db, $_POST['material_id']);
	$minimum_quantity = mysqli_real_escape_string($db, $_POST['minimum_quantity']);
	$present_quantity = mysqli_real_escape_string($db, $_POST['present_quantity']);

	$query = "INSERT INTO mrp (eid, material_name, material_id, minimum_quantity, present_quantity) 
  			  VALUES('$eid', '$material_name', '$material_id', '$minimum_quantity', '$present_quantity')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "data inserted successfully";
  	  header('location: index.php');
}


//update data in db
if (isset($_POST['update'])) {
    $eid = mysqli_real_escape_string($db, $_POST['eid']);
	$material_id = mysqli_real_escape_string($db, $_POST['material_id']);
	$present_quantity = mysqli_real_escape_string($db, $_POST['present_quantity']);

  if (empty($eid)) {
  	array_push($errors, "eid is required");
  }
  if (empty($material_id)) {
  	array_push($errors, "material_id is required");
  }
  if (empty($present_quantity)) {
  	array_push($errors, "present_quantity is required");
  }

  if (count($errors) == 0) {
  	$query = "UPDATE mrp SET present_quantity='$present_quantity' WHERE eid='$eid' AND material_id='$material_id'";
  	$results = mysqli_query($db, $query);
  	  $_SESSION['success'] = "updated successfully";
  	  header('location: index.php');
  	
  }
}


//delete data from db
if (isset($_POST['delete'])) {
    $eid = mysqli_real_escape_string($db, $_POST['eid']);
	$material_id = mysqli_real_escape_string($db, $_POST['material_id']);

  if (empty($eid)) {
  	array_push($errors, "eid is required");
  }
  if (empty($material_id)) {
  	array_push($errors, "material_id is required");
  }

  if (count($errors) == 0) {
  	$query = "DELETE FROM mrp WHERE eid='$eid' AND material_id='$material_id'";
  	$results = mysqli_query($db, $query);
  	  $_SESSION['success'] = "deleted successfully";
  	  header('location: index.php');
  	
  }
}


//printing table
 if (isset($_POST['retrieve'])) {

        $query = "SELECT * FROM mrp";
    $result = mysqli_query($db, $query);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Eid---</th><th>Material_Name---</th><th>Material_id--- </th><th>Minimum_quantity--- </th><th>Present_quantity</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["eid"]."</td><td>".$row["material_name"]."</td><td>".$row["material_id"]."</td><td>".$row["minimum_quantity"]."</td><td>".$row["present_quantity"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        
}



?>