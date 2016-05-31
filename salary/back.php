<?php

//This function validates entered salary details
	function validate($salary, $amount_paid, $method)
	{
		$error="";
		if(strlen($salary)<1){$error.="<br>Please Enter a Valid Salary"; }
		if(strlen($amount_paid)<1){$error.="<br>Please Enter a Valid Amount Paid"; }
		if(strlen($method)<3){$error.="<br>Please Enter a Valid Method"; }
		if(strlen($error)>0){
			return $error; 
		}
		return null;
	}

	
	//This function returns a connection to the database
	function connect()
	{
		$connection = mysqli_connect("localhost", "root", "") or die(mysqli_error($connection)."connection fail<br>");

		mysqli_select_db($connection, "salon") or die(mysqli_error($connection)."db selection fail<br>");

		return $connection;
	}


	//This function lists all users
	function listAll()
	{
		$connection = connect();

		$rows = mysqli_query($connection, "SELECT * FROM user") or die(mysqli_error($connection)."selectAll fail<br>"); 

		return $rows;
	}


//This function inserts new salary details
		function insert($id, $amount_paid, $salary, $method, $month, $year)
		{
			$connection = connect();
			mysqli_query($connection, "INSERT IGNORE INTO salary VALUES(0, $id, '$amount_paid', '$method', '$salary', '$month', '$year')") or die(mysqli_error($connection)."insertion fail<br>"); 
		}

//This function returns row containing $id as id
		function selectNames($id){
			$connection = connect();

			$rows = mysqli_query($connection, "SELECT * FROM user where id='$id'") or die(mysqli_error($connection)."select_names fail<br>"); 
			$row = mysqli_fetch_array($rows);

			return $row;
		}


//This function returns salaries paid within selected timeframe
		function selectRecord($month, $year)
		{
			$connection = connect();

			$rows = mysqli_query($connection, "SELECT * FROM salary where month='$month' and year='$year'") or die(mysqli_error($connection). "selection fail<br>");

			if($rows->num_rows<1){

				echo"<p><h3><B>No Salaries Were Paid Within The Selected Time-Frame</b></h3></p>";
			}
			else{

				echo"<table class=\"table\">
    <thead><th>Firstname</th><th>Lastname</th><th>Salary</th><th>Amount Paid</th><th>Month</th><th>Year</th><th>Method</th><th></th><th></th></thead>
    <tbody>";
			while($row=mysqli_fetch_array($rows)){
				$sql = selectNames($row["user_id"]);
				echo "<tr><td>".$sql["firstname"]."</td><td>".$sql["lastname"]."</td><td>".$row["salary"]."</td><td>".$row["amount_paid"]."</td><td>".$row["month"]."</td><td>".$row["year"]."</td><td>".$row["method"]."</td><td><form action=\"edit.php\" method=\"post\"><input type=\"text\" hidden value=\"".$row["id"]."\" name=\"id\"><input type=\"submit\" value=\"edit\" class=\"btn btn-xs\"></form></td><td><form action = \"salary.php\" method=\"post\"><input hidden type=\"text\" value=\"".$row["id"]."\" name=\"delete_id\"><input type=\"submit\" value=\"delete\" class=\"btn btn-xs\"></form></td></tr>";
			}}
		}


//This function returns row containing $id as id
		function selectRecordForEdit($id){

			$connection = connect();

			$rows = mysqli_query($connection, "SELECT * FROM salary where id='$id'") or die(mysqli_error($connection)."selectFail<br>");

			$row = mysqli_fetch_array($rows);

			return $row;
		}

//This function deletes row containing $id as id
		function deleteRow($id){
			$connection = connect();

			mysqli_query($connection, "DELETE FROM salary where id='$id'") or die(mysqli_error($connection)."delete fail<br>");


		}


//This function updates row containing $id as id
		function editSalaryRecord($id, $salary, $amount_paid, $month, $method, $year)
		{
			$connection = connect(); 

			mysqli_query($connection, "UPDATE salary set salary='$salary', amount_paid='$amount_paid', method='$method', month='$month', year='$year' where id='$id'") or die(mysqli_error($connection)."update_fail<br>");

		}


?>