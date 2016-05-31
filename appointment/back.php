<?php
//This function returns a connection to the database
function connect(){
	$connection = mysqli_connect("localhost", "root", "") or die(mysqli_error($connection)."connection fail<br>"); 

	mysqli_select_db($connection, "salon") or die(mysqli_error($connection)."db_selection fail<br>"); 

	return $connection;
}


//This function returns all customer records from database
function selectAllCustomers(){

	$connection = connect();

	$rows = mysqli_query($connection,"SELECT * FROM user where type='customer'") or die(mysqli_error($connection)."customer_selection_fail<br>");

while($row=mysqli_fetch_array($rows)){
		echo"<option value=\"".$row["id"]."\">".$row["firstname"]." ".$row["lastname"]."</option>";
	}
}

//This function adds a new appointment to database
function insertAppointment($C_id, $date, $time){

	$connection = connect();

	$rows = mysqli_query($connection, "SELECT * FROM appointment where customer_id='$C_id' and date='$date' and time='$time'") or die(mysqli_error($connection)."if_exists_fail<br>");
	if($rows->num_rows>0){return "This appointment has already been created."; }else{

	mysqli_query($connection, "INSERT INTO appointment (customer_id, date, time) VALUES('$C_id', '$date', '$time')") or die(mysqli_error($connection)."insertion fail<br>");

	 return "Appointment Succesfully Created.";}

}


//This function returns row containing $C_id as id
function fetchName($C_id){

	$connection = connect();

	$rows = mysqli_query($connection, "SELECT * FROM user where id='$C_id'") or die(mysqli_error($connection)."fetchname_fail<br>");

	$row = mysqli_fetch_array($rows);

	return $row;
}


//The function returns all appointments as table
function showAllAppointments(){

	$connection = connect();

	$rows = mysqli_query($connection, "SELECT * from appointment") or die(mysqli_error($connection)."showAppointments_fail<br>");

	while($row=mysqli_fetch_array($rows)){
		$C_id = fetchName($row["customer_id"]);
		echo "<tr><td>".$C_id["firstname"]." ".$C_id["lastname"]."</td><td>".$row["date"]."</td><td>".$row["time"]."</td><td><form action=\"edit.php?C_id=".$C_id["id"]."\" method=\"post\"><input type=\"text\" value=\"".$row["id"]."\" hidden name=\"id\"><input type=\"submit\" value=\"edit\" class=\"btn btn-xs\"></form></td><td><form action\"appointment.php\" method=\"post\"><input type=\"text\" value=\"".$row["id"]."\" hidden name=\"delete_id\"><input type=\"submit\" value=\"delete\" class=\"btn btn-xs\"></form></td></tr>";
	}

}

//This function deletes appointment with $id as id 
function deleteAppointment($id){

	$connection = connect();

	mysqli_query($connection, "DELETE FROM appointment where id='$id'");
}



//This function selects appointment with $id as id
function selectAppointment($id){

	$connection = connect();

	$sqls = mysqli_query($connection, "SELECT * from appointment where id='$id'") or die(mysqli_error($connection)."selectAppointment_fail<br>");

	$sql = mysqli_fetch_array($sqls);

	return $sql;
}


//This function updates appointment with $id as id
function updateAppointment($C_id, $date, $time, $id){

$connection = connect();

mysqli_query($connection, "UPDATE appointment set customer_id='$C_id', date='$date', time='$time' where id='$id'") or die(mysqli_error($connection)."updateAppointment_fail<br>");

return "Appointment successfully updated!";

}

?>