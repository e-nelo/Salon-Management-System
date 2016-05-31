<?php 
if(session_start())
{session_destroy(); 
 $_SESSION = array();}
header("location:index.php");

//This page destroys all set session values and sets the $_SESSION array to an empty array, thus effectively logging out any logged in user.
 ?>