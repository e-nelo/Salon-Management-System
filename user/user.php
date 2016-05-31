<?php 
include("../header.php"); 
include("back.php");
$error="";

//if the user clicks on delete, call deleteRecord function from back.php
if(isset($_POST["action"]) && $_POST["action"]=="delete")
{
    $id = $_GET["id"];
    deleteRecord($id);
}
//if registration values are set, call validate function. If no errors are found, insert the values into the database
if(isset($_POST["firstname"]))
{
    $type=$_POST["type"];
    $firstname = $_POST["firstname"];
    $lastname= $_POST["lastname"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];
    $address= $_POST["address"];
    $gender= $_POST["gender"];
    $password= $_POST["password"];
    $password_confirm= $_POST["password_confirm"];
    

    $error = validate($firstname, $lastname, $email, $phone, $address, $gender, $password, $password_confirm);

    if($error==false)
    {
       $connection = connect();
       $error = insert($firstname, $lastname, $email, $phone, $address, $gender, $password, $type);
    }

}
?>   

    <section >
        <div class="container">
            <div class="row">
                <div class='col-lg-3'>
                <div id='call_user_reg' onclick='show_user_reg()' 
                        <i class='fa fa-plus'></i> 
                        <span> Add User </span> 
                </div>
                <br>
                <div  id="user_reg" hidden>
                <h3>Add A User</h3>
                    <form class="form" action="user.php" method="post">
                    <div class="form-group">
                        <input type="text" required autofocus="true" name="firstname" placeholder="Enter First Name" class="form-control"<?php if(isset($_POST["firstname"])){echo "value=\"".$firstname."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="text" required autofocus="true" name="lastname" placeholder="Enter Last Name" class="form-control" <?php if(isset($_POST["lastname"])){echo "value=\"".$lastname."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="text" required name="email" placeholder="Enter Email" class="form-control"<?php if(isset($_POST["email"])){echo "value=\"".$email."\""; }?> >
                    </div>
                    <div class="form-group">
                        <input type="text" required name="phone" placeholder="Enter Phone Number" class="form-control" <?php if(isset($_POST["phone"])){echo "value=\"".$phone."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="text" required name="address" placeholder="Enter Address" class="form-control" <?php if(isset($_POST["address"])){echo "value=\"".$address."\""; }?>>
                    </div>
                    <div class="form-group">
                        <select style="color: black;" required name="gender" placeholder="Select Gender" class="form-control"<?php if(isset($_POST["gender"])){echo "value=\"".$gender."\""; }?>>
                        <option>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select style="color: black;" required name="type" placeholder="Select Gender" class="form-control"<?php if(isset($_POST["type"])){echo "value=\"".$type."\""; }?>>
                        <option>Select User Type</option>
                            <option value="customer">Customer</option>
                            <option value="stylist">Stylist</option>
                            <option value="admin">Admin</option>
                     </select>
                    </div>
                    <div class="form-group">
                        <input type="text" required name ="password" placeholder="Enter password" class="form-control" <?php if(isset($_POST["password"])){echo "value=\"".$password."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="text" required name="password_confirm" placeholder="Confirm Password" class="form-control" <?php if(isset($_POST["password_confirm"])){echo "value=\"".$password_confirm."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="done" class="btn btn-block form-control" >
                    </div>
                    </form>
                </div>
                </div>
                <div class="col-lg-9" id="validate"><br><br><b style="color:red;"> <br><?php echo $error; ?></b></div>

                 <div class="col-lg-5 pull-left" id="selectAll">
                    <table class="table">
                       <thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Gender</th><th>Password</th><th>Edit</th><th>Delete</th></tr></thead>

                       <?php selectAllToTable(); ?>
                    </table>
               </div> 
            </div>
        </div>
    </section>
    <?php include("../footer.php"); ?>


    <script type='text/javascript'>
//This function shows/hides the registration form 
    function show_user_reg(){

        $("#add_user_reg").toggle(1000);
        $("#user_reg").val("Close User Reg Form");
        $("#user_reg").toggle(1000);
    }


    </script>