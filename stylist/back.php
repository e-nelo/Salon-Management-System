<?php 
//This function checks entered input for errors
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

//This function returns a connection to the database
	function connect()
	{
		$connection = mysqli_connect("localhost", "root", "") or die(mysqli_error($connection)."connection failed<br>");

		mysqli_select_db($connection, "salon") or die(mysqli_error($connection)."db selection fail<br>");

		return $connection;
	}


//This function returns records of all stylists to a table
	function selectAllToTable()
	{
		$connection  = connect();
		$rows = mysqli_query($connection, "SELECT * from user where type='stylist'") or die(mysqli_error($connection)."selectAll fail<br>");
		while($row = mysqli_fetch_array($rows))
		{
			echo "<tr>"; 
			echo "<td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["address"]."</td><td>".$row["gender"]."</td><td>".$row["password"]."</td><td><form action=\"edit.php?id=".$row["id"]."\" method=\"post\"><input hidden=\"true\" type=\"text\" name=\"action\" value=\"edit\"><input type=\"submit\" class=\"btn btn-xs\" value=\"Edit\"></form></td><td><form action=\"stylist.php?id=".$row["id"]."\" method=\"post\"><input hidden=\"true\" type=\"text\" name=\"action\" value=\"delete\"><input type=\"submit\" class=\"btn btn-xs\" value=\"delete\"></form></td>";
			echo "</tr>";
		}	

	}

	
//This function returns all rows containing the values passed to it
	function select($email, $phone)
	{
		$connection = connect();
		$rows = mysqli_query($connection, "SELECT * FROM user where phone='$phone' and email='$email'") or die(mysqli_error($connection)."rows selection fail<br>"); 
		return $rows; 
	}



//This function inserts new stylist records to the database
	function insert($firstname, $lastname, $email, $phone, $address, $gender, $password)
	{ 
		//check if stylist is already in database

		$rows = select($email, $phone);
		$row = mysqli_fetch_array($rows);
		$connection = connect();
		if($row==null)
		{

			mysqli_query($connection, "INSERT IGNORE INTO user VALUES(0, '$firstname', '$lastname', '$phone', '$email', '$address', '$gender', '$password', 'stylist')") or die(mysqli_error($connection)."insert fail<br>");

		}

		else{return "This stylist already exists in the database";}
	}


//This function returns records containing the value passed to it as id
	function selectId($id)
	{
		$connection = connect();

		$rows = mysqli_query($connection, "SELECT * FROM user where id='$id'") or die(mysqli_error($connection)."select fail<Br>");

		return $rows;
	}


//This function updates the row containing $id as id with the values passed to it.
	function edit($id, $firstname, $lastname, $email, $phone, $address, $gender, $password, $type="")
	{
		 
		$connection = connect();

		mysqli_query($connection, "UPDATE user set firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', address='$address', gender='$gender', password='$password' where id='$id'") or die(mysqli_error($connection)."edit fail<br>");
		select($email, $phone); 

		header("location:http://localhost/salon/stylist/stylist.php");

	}


//This function deletes the record of the row containing $id as id
	function deleteRecord($id)
	{
		$connection = connect();

		mysqli_query($connection, "DELETE from user where id='$id'") or die(mysqli_error($connection)."delete fail<br>");

		header("location:http://localhost/salon/stylist/stylist.php");

	}

?>