<?php 
include("../header.php"); 
include("back.php");?>
<section><div class="container"><div class="row">
<?php 
            if(isset($_POST["firstname"]))
                  {
                     
                    $type= "customer";
                    $firstname= $_POST["firstname"];
                    $lastname= $_POST["lastname"];
                    $email= $_POST["email"];
                    $phone= $_POST["phone"];
                    $address= $_POST["address"];
                    $gender= $_POST["gender"];
                    $password= $_POST["password"];
                    
                    $id = $_GET['id'];


                    $error = validate($firstname, $lastname, $email, $phone, $address, $gender, $password);
                    if($error==false)
                    {
                        ?>
                        <div class="col-lg-5">
                         <table class="table">
                       <thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Gender</th><th>Password</th><th>Edit</th><th>Delete</th></tr></thead>

                       <?php edit($id, $firstname, $lastname, $email, $phone, $address, $gender, $password); ?>
                    </table></div>
                        <?php
                    }
                    else{
                        die("error updating!");
                    }


                  } 
                    $id = $_GET["id"];
                    $rows = selectId($id);
                    $row = mysqli_fetch_array($rows);
                   
?> <div class="col-lg-5" id="edit">
                <b><h3>Update Profile</b></h3>
                    <form class="form" action="edit.php?id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                        <input type="text" required autofocus="true" name="firstname" placeholder="Enter First Name" class="form-control" value="<?php echo $row["firstname"];?>">
                    </div>
                    <div class="form-group">
                        <input type="text" required autofocus="true" name="lastname" placeholder="Enter Last Name" class="form-control" value="<?php echo $row["lastname"];?>">
                    </div>
                    <div class="form-group">
                        <input type="text" required name="email" placeholder="Enter Email" class="form-control"value="<?php echo $row["email"];?>">
                    </div>
                    <div class="form-group">
                        <input type="text" required name="phone" placeholder="Enter Phone Number" class="form-control"value="<?php echo $row["phone"];?>">
                    </div>
                    <div class="form-group">
                        <input type="text" required name="address" placeholder="Enter Address" class="form-control" value="<?php echo $row["address"];?>">
                    </div>
                   
                    <div class="form-group">
                        <input type="text" name="gender" class="form-control" placeholder="Enter Gender" value="<?php echo $row["gender"];?>">
                    </div>
                    <div class="form-group">
                        <input type="text" required name ="password" placeholder="Enter password" class="form-control" value="<?php echo $row["password"];?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="done" class="btn btn-block form-control" >
                    </div>
                    </form>
                </div>

                   
               </div>            
            </div>
        </div>
    </section>
    <?php include("../footer.php"); ?>