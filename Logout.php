<?php require_once("include/Functions.php");?>
<?php require_once("include/Sessions.php");?>
<?php
 $_SESSION["User_Id"]=null;
 $_SESSION["UserType"]=null;
 session_destroy();
 Redirect_to("login");


?>