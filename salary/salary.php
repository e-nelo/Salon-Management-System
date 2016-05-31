<?php include("../header.php"); 
include("back.php");  $error = "";
//select input code
$rows = listAll();

if(isset($_POST["delete_id"]) && $_POST["delete_id"]>0)
{
    deleteRow($_POST["delete_id"]);
}

if(isset($_POST["id"]))
{ 
    $id = $_POST["id"];
    $salary = $_POST["salary"];
    $amount_paid = $_POST["amount_paid"];
    $month = $_POST["month"];
    $year = $_POST["year"]; var_dump($_POST);
    $method = $_POST["method"];
    $error = validate($salary, $amount_paid, $method);
    if($error==null)insert($id, $amount_paid, $salary, $method, $month, $year); 
}
?>   

    <section >
        <div class="container">
            <div class="row">
               <div class="col-lg-3" id="selectUser">

               <div id='show_form' onclick='show_form()'>
               <i class='fa fa-plus'></i> <span> Pay New Salary </span>
               </div>

               <div id='salary_form' hidden>
                 <h3>Salary Form </h3>
                    <form class="form" action="salary.php" method="post">
                    <div class="form-group">
                        <select class="form-control" name="id"><?php while($row= mysqli_fetch_array($rows))
                        {
                            echo "<option value=\"".$row["id"]."\">".$row["firstname"]." ".$row["lastname"]."</option>";
                        }
                        ?></select>                        
                    </div>
                    <div class="form-group">
                    <input type="text" required name="salary" placeholder="Salary Amount" class="form-control" <?php if(isset($_POST["salary"])){echo "value=\"".$_POST["salary"]."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="text"required name="amount_paid" placeholder="Amount Paid" class="form-control" <?php if(isset($_POST["amount_paid"])){echo "value=\"".$_POST["amount_paid"]."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="text" required name="method" class="form-control" placeholder="Enter Method" <?php if(isset($_POST["method"])){echo "value=\"".$_POST["method"]."\""; }?>>
                    </div>
                    <div class="form-group">
                        <select class="form-control" style="color: black;" name="month"><option>Select Month</option>
                            <?php $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"); 
                                for($i = 0; $i< sizeof($months); $i++)
                                {
                                    echo "<option value=\"".$months[$i]."\">".$months[$i]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" style="color: black;" name="year"><option>Select Year</option>
                            <?php $years = range(2016, 2050); 
                            for($i= 0; $i<sizeof($years); $i++)
                            {
                                echo "<option value=\"".$years[$i]."\">".$years[$i]."</option>";
                                } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="done" class="btn btn-block form-control" >
                    </div>
                    </form>
                    </div>
                </div>

                <div class="col-lg-9" id="error">
               <b style="color: red;"> <?php echo $error; ?></b>
                </div>
  

    <div class="col-lg-5" name="listForm">
    <h3><B>View Paid Salary</B></h3>
    <form action="salary.php" method="post">
    <div class="form-group">
        <select class="form-control" style="color: black;" required name="selectYear">
        <option>Select Year</option>
           <?php $years = range(2016, 2050); 
               for($i= 0; $i<sizeof($years); $i++)
                            {
                 echo "<option value=\"".$years[$i]."\">".$years[$i]."</option>";
                     } ?>

           </select>
    </div>
    <div class="form-group">
       <select class="form-control" style="color: black;" name="selectMonth" required>
       <option>Select Month</option>
           <?php $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"); 
             for($i = 0; $i< sizeof($months); $i++)
              {
                echo "<option value=\"".$months[$i]."\">".$months[$i]."</option>";
               }
            ?>
           </select>
    </div>
    <div class="form-group">
       <input type="submit" class="btn btn-block" class="form-control"> 
    </div>
    </form>
    </div>  
    </div>

    <div class='row'> 
    <div class='col-lg-3'> </div>
<div class="col-lg-6" id ="showSalaryDetails">

        <?php if(isset($_POST["selectMonth"])){
            $month = $_POST["selectMonth"];
            $year = $_POST["selectYear"];
            selectRecord($month, $year);
        }?>
    </tbody>

</table> 
</div>

    <div class='col-lg-3'> </div>
</div>

        </div>
        </div>
    </section>
    <?php include("../footer.php"); ?>

     <script type='text/javascript'>

    function show_form(){

        $("#salary_form").toggle(1000);
        $("#user_reg").val("Close User Reg Form");
        $("#user_reg").toggle(1000);
    }


    </script>