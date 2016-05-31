<?php include("header.php"); include("back.php"); 
$message = "";
//if form has been submitted, call login function from included file(back.php)
    if(isset($_POST["email"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $message= login($email, $password);
        if(strlen($message) < 1 && strlen($menu)<1)header("location:index.php");
    }
 ?>   

    <section >
        <div class="container">
            <div class="row">
                <?php if(isset($_SESSION["email"])){?>
                <?php  echo "<h3><b>Hi, You are Logged In As ".$_SESSION["name"]."</b></h3>";} else{ ?>
                <div class="col-lg-5">
                <B><h2>Log In Form</h2></B>
                	<form class="form" action= "index.php" method="post">
                	<div class="form-group">
                		<input type="text" required name="email" placeholder="Enter Email" class="form-control" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" <?php if(isset($_POST["email"])){echo "value=\"".$_POST["email"]."\"";}?>>
                	</div>
                	<div class="form-group">
                		<input type="text" required name ="password" placeholder="Enter password" class="form-control" <?php if(isset($_POST["password"])){echo "value=\"".$_POST["password"]."\"";}?>>
                	</div>
                	<div class="form-group">
                		<input type="submit" value="done" class="btn btn-block form-control">
                	</div>
                	</form>
                </div>
                <div class="col-lg-5"><b><h3 style="color: green;"><?php echo $message; ?></h3></b></div>            
            </div>
        </div>
    </section>
    <?php }include("footer.php"); ?>