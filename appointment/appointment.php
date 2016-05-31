<?php include("../header.php"); include("back.php"); $error="";
if(isset($_POST["date"])){
    $date = $_POST["date"];
    $time= $_POST["time"]; 
    $C_id = $_POST["C_id"];
    $error =insertAppointment($C_id, $date, $time);
    } 

if(isset($_POST["delete_id"])){
    $id = $_POST["delete_id"];
    deleteAppointment($id);
}
    ?>   

    <section >
        <div class="container">
            <div class="row">
               <div class="col-lg-5" id="form">
               <h3><b>Appointment Form</b></h3><br>
                     <form action="appointment.php" method="post">
                         <div class="form-group">
                         <label style="display: inline;">Date: </label>
                             <input required class="form-control" placeholder="dd-mm-yy" name="date" type="text" pattern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$" <?php if(isset($_POST["date"])){echo "value=\"".$_POST["date"]."\"";}?>>
                         </div>


                         <div class="form-group">
                         <label style="display: inline;">Time: </label>
                             <input name="time" type="text" required pattern="^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$"  class="form-control" placeholder="00:00"  <?php if(isset($_POST["time"])){echo "value=\"".$_POST["time"]."\"";}?>>
                         </div>


                         <div class="form-group">
                         <label style="display: inline;">Select Customer: </label>                
                            <select required class="form-control" name="C_id">
                            <option disabled>Select Customer</option>
                            <?php selectAllCustomers(); ?>
                            </select>                             
                         </div>

                         <div class="form-group">
                            <input type="submit" style="color: black;" value="DONE" class="form-control btn-block"> 
                         </div>
                     </form>       
               </div>    

               <div class="col-lg-5">
                   <h3><b style="color: red;"><?php echo $error; ?></b></h3>
               </div>


               <div class="col-lg-5" id="showAllAppointments">
                   <table class="table"><h3><b>All Appointments</b></h3>
                       <thead><th>Customer Name</th> <th>Appointment Date</th> <th>Appointment Time</th><th></th><th></th></thead>
                       <tbody>
                           <?php showAllAppointments(); ?>
                       </tbody>
                   </table>
               </div>


            </div>
        </div>
    </section>
