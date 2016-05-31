<?php
include("../header.php");
include("back.php");
	$id = $_POST["id"];
	if(isset($_POST["delete_id"]))
	{
		deleteRow($id);
	}
	$row = selectRecordForEdit($id); 
	$sql = selectNames($row["user_id"]);
$error = ""; 
$month = ""; $year;
if(isset($_POST["year"]))
{
	$year = $_POST["year"];
	$month = $_POST["month"];
	$amount_paid = $_POST["amount_paid"];
	$method = $_POST["method"];
	$salary = $_POST["salary"];
	
	editSalaryRecord($id, $salary, $amount_paid, $month, $method, $year);


}
?>


    <section >
        <div class="container">
            <div class="row">
               <div class="col-lg-5" id="selectUser">
                <b><h3><?php echo $sql["firstname"]." ".$sql["lastname"]."'s "; ?>Salary Form</b></h3>
                    <form class="form" action="edit.php" method="post">
                   
                    <div class="form-group">
                    <input type="text" required name="salary" placeholder="Salary Amount" class="form-control" <?php if(isset($_POST["salary"])){echo "value=\"".$_POST["salary"]."\""; }else{ echo "value=\"".$row["salary"]."\"";}?>>
                    </div>
                    <div class="form-group">
                        <input type="text"required name="amount_paid" placeholder="Amount Paid" class="form-control" <?php if(isset($_POST["amount_paid"])){echo "value=\"".$_POST["amount_paid"]."\""; }else{ echo "value=\"".$row["amount_paid"]."\"";}?>>
                    </div>
                    <div class="form-group">
                        <input type="text" required name="method" class="form-control" placeholder="Enter Method" <?php if(isset($_POST["method"])){echo "value=\"".$_POST["method"]."\""; }else{ echo "value=\"".$row["method"]."\"";}?>>
                    </div>
                    <div class="form-group">
                        <input required class="form-control" name="month" type="text" <?php if(isset($_POST["month"])){echo "value=\"".$_POST["month"]."\""; }else{ echo "value=\"".$row["month"]."\"";}?>>
                    </div>
                    <div class="form-group">
                        <input required class="form-control" name="year" type="text" <?php if(isset($_POST["year"])){echo "value=\"".$_POST["year"]."\""; }else{ echo "value=\"".$row["year"]."\"";}?>>
                    </div>
                    <input type="text" value="<?php echo $id; ?>" name="id" hidden="true">
                    <div class="form-group">
                        <input type="submit" value="done" class="btn btn-block form-control" >
                    </div>
                    </form>
                </div>
                <div class="col-lg-5">
                <h3><b>Edited Records for <?php echo $sql["firstname"]." ".$sql["lastname"]." "; ?></b></h3>
                	<?php if(isset($_POST["year"])){selectRecord($month, $year); }?>
                </div>
</div></div></section>
                


