<?php include("../header.php"); require("back.php");
$error = "";

if(isset($_POST["action"]) && $_POST["action"]=="delete")
{
    $id = $_GET["id"];
    deleteRecord($id);
}
if(isset($_POST["firstname"]))
{
    $type= "stylist";
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
       $error = insert($firstname, $lastname, $email, $phone, $address, $gender, $password);
    }

}
 ?>   

    <section >
        <div class="container">
            <div class="row">
                <div class="col-lg-3" id="register">

                <div onclick='show_form()'>
                <i class='fa fa-plus'></i> Add Stylist
                </div>

                <div id='stylist_form' hidden>
                 <h3>Stylist Registration </h3>
                	<form class="form" action="stylist.php" method="post">
                    <div class="form-group">
                        <input type="text" required autofocus="true" name="firstname" placeholder="Enter First Name" class="form-control"<?php if(isset($_POST["firstname"])){echo "value=\"".$firstname."\""; }?>>
                    </div>
                    <div class="form-group">
                        <input type="text" required autofocus="true" name="lastname" placeholder="Enter Last Name" class="form-control" <?php if(isset($_POST["lastname"])){echo "value=\"".$lastname."\""; }?>>
                    </div>
                	<div class="form-group">
                		<input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required name="email" placeholder="Enter Email" class="form-control"<?php if(isset($_POST["email"])){echo "value=\"".$email."\""; }?> >
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
                <div class="col-lg-5 pull-right"><br><br><b style="color:red;"> <br><?php echo $error; ?></b></div>
                </div>
               <div class="col-lg-5 pull-left" id="selectAll">
                    <table class="table">
                       <thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Gender</th><th>Password</th><th>Edit</th><th>Delete</th></tr></thead>

                       <?php selectAllToTable(); ?>
                    </table>
               </div> 

               
               </div>            
            </div>
        </div>
    </section>
    <?php include("../footer.php"); ?>

      <script type='text/javascript'>

    function show_form(){

        $("#stylist_form").toggle(1000); 
         
    }


    </script>