<?php 
//This function validates entered values for errors
	function validate($firstname, $lastname, $email, $phone, $address, $gender, $password, $password_confirm = "")
	{
		$error="";
		if(strlen($firstname)<3)
		{
				$error.="Please Enter a Valid First Name<br>";
				
		}

		if(strlen($lastname)<3)
		{
			$error .= "Please Enter a Valid Last Name<br>";
			 
		}

		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if(!filter_var($email, FILTER_SANITIZE_EMAIL)===false)
		{
			$error = $error; 
		}else{
			$error.="Please Enter a Valid Email<br>";
		}

		if(strlen($phone)<11){
			$error.="Please Enter a Valid Phone Number<br>";
		}

		if(strlen($address)<3){
			$error.="Please Enter a Valid Address<br>";
		}

		if(strlen($gender)<4){
			$error .="Please Enter a Valid Gender<br>";
		}

		 

		if(strlen($error)>0){
			return $error; 
		}
		return false;
	}


//This function returns a connectio to the database
	function connect()
	{
		$connection = mysqli_connect("localhost", "root", "") or die(mysqli_error($connection)."connection failed<br>");

		mysqli_select_db($connection, "salon") or die(mysqli_error($connection)."db selection fail<br>");

		return $connection;
	}


//This functio returns all customers in database in a table
	function selectAllToTable()
	{
		$connection  = connect();
		$rows = mysqli_query($connection, "SELECT * from user where type='customer'") or die(mysqli_error($connection)."selectAll fail<br>");
		while($row = mysqli_fetch_array($rows))
		{
			echo "<tr>"; 
			echo "<td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["address"]."</td><td>".$row["gender"]."</td><td>".$row["password"]."</td><td><form action=\"edit.php?id=".$row["id"]."\" method=\"post\"><input hidden=\"true\" type=\"text\" name=\"action\" value=\"edit\"><input type=\"submit\" class=\"btn btn-xs\" value=\"Edit\"></form></td><td><form action=\"customer.php?id=".$row["id"]."\" method=\"post\"><input hidden=\"true\" type=\"text\" name=\"action\" value=\"delete\"><input type=\"submit\" class=\"btn btn-xs\" value=\"delete\"></form></td>";
			echo "</tr>";
		}	

	}

	
//This function returns the row containing the email and phone number passed to it
	function select($email, $phone)
	{
		$connection = connect();
		$rows = mysqli_query($connection, "SELECT * FROM user where phone='$phone' and email='$email'") or die(mysqli_error($connection)."rows selection fail<br>"); 
		return $rows; 
	}


//This function creates a new customer row
	function insert($firstname, $lastname, $email, $phone, $address, $gender, $password, $type="")
	{ 
		//check if customer is already in database

		$rows = select($email, $phone);
		$row = mysqli_fetch_array($rows);
		$connection = connect();
		if($row==null)
		{

			mysqli_query($connection, "INSERT IGNORE INTO user VALUES(0, '$firstname', '$lastname', '$phone', '$email', '$address', '$gender', '$password', '$type')") or die(mysqli_error($connection)."insert fail<br>");

		}

		else{return "This customer already exists in the database";}
	}


//This function returns row containing $id as id 
	function selectId($id)
	{
		$connection = connect();

		$rows = mysqli_query($connection, "SELECT * FROM user where id='$id'") or die(mysqli_error($connection)."select fail<Br>");

		return $rows;
	}


//This function updates row containing $id as id
	function edit($id, $firstname, $lastname, $email, $phone, $address, $gender, $password, $type="")
	{
		 
		$connection = connect();

		mysqli_query($connection, "UPDATE user set firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', address='$address', gender='$gender', password='$password' where id='$id'") or die(mysqli_error($connection)."edit fail<br>");
		select($email, $phone); 

		header("location:http://localhost/salon/customer/customer.php");

	}


//This function deletes row containing $id as id
	function deleteRecord($id)
	{
		$connection = connect();

		mysqli_query($connection, "DELETE from user where id='$id'") or die(mysqli_error($connection)."delete fail<br>");

		header("location:http://localhost/salon/customer/customer.php");

	}

?>