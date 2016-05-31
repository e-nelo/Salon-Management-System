<?php 
include("../header.php");
include("back.php");
$error = "";
$C_id = $_GET["C_id"]; 
$row = fetchName($C_id);

$id = $_POST["id"]; 
$sql = selectAppointment($id);

if(isset($_POST["date"])){
	$date = $_POST["date"];
	$time = $_POST["time"];
	$C_id= $C_id;
	$error = updateAppointment($C_id, $date, $time, $id);
}
?>
<section>
	<div class="container">
		<div class="row">
			
<div class="col-lg-5">
	<h3><b><?php echo $row["firstname"]." ".$row["lastname"]; ?>'s Appointment Form</b></h3><br>
                     <form action="edit.php?C_id=<?php echo $C_id; ?>" method="post">

                         <div class="form-group">
                         <label style="display: inline;">Date: </label>
                             <input required class="form-control" placeholder="dd-mm-yy" name="date" type="text" pattern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$" <?php if(isset($_POST["date"])){echo "value=\"".$_POST["date"]."\"";}else{echo "value=".$sql["date"];}?>>
                         </div>

                         <input type="text" name ="id" value="<?php echo $sql["id"]; ?>" hidden>

                         <div class="form-group">
                         <label style="display: inline;">Time: </label>
                             <input name="time" type="text" required pattern="^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$"  class="form-control" placeholder="00:00"  <?php if(isset($_POST["time"])){echo "value=\"".$_POST["time"]."\"";}else{ echo"value=".$sql["time"]; }?>>
                         </div>


                        <div class="form-group">
                            <input type="submit" style="color: black;" value="DONE" class="form-control btn-block"> 
                         </div>
                     </form>  
</div>


<div class="col-lg-5" id="error">
	<h3><b style="color: red;"><?php echo $error; ?></b></h3>
</div>

		</div>
	</div>
</section>