<?php 
//This function creates a connection to the database
function connect(){
	$connection = mysqli_connect("localhost", "root", "") or die(mysqli_error($connection)."connection_fail<br>");

	mysqli_select_db($connection, "salon") or die(mysqli_error($connection)."db_selection fail<br>"); 

	return $connection;
}


//This function checks whether the entered values match the values in the database. If they do it creates a session with the entered values. If they dont, it returns an error message.
function login($email, $password){

	$connection = connect();

	$rows = mysqli_query($connection, "SELECT * FROM user where email='$email' and password='$password'") or die(mysqli_error($connection)."selection fail<br>");

	$row = mysqli_fetch_array($rows);

	if($row){
		$_SESSION["type"] = $row["type"];
		$_SESSION["name"] =  $row["firstname"]." ".$row["lastname"];
		$_SESSION["password"] = $row["password"];
		$_SESSION["email"] = $row["email"];		
		$_SESSION["gender"] = $row["gender"];
		$_SESSION["address"] = $row["address"];
		$_SESSION["phone"]= $row["phone"];
  	}else{
  		return "Your Email Does Not Match Your Password. Try Again or Contact Admin.";
  	}

}

?>