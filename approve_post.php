<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login(); ?>
<?php
if(isset($_REQUEST["id"])){
    global $connection;
    $IDFromURL=mysqli_real_escape_string($connection, $_REQUEST["id"]);
    $IDFromURL=htmlentities(htmlspecialchars($IDFromURL, ENT_COMPAT,'ISO-8859-1', true),ENT_COMPAT,'ISO-8859-1', true); // xss protection
    if($_SESSION["UserType"]=="0"){
        $Query="UPDATE admin_panel SET status='1' WHERE id='$IDFromURL'" or die("error");
        $Execute=mysqli_query($connection,$Query);
        if($Execute){
            $_SESSION["SuccessMessage"]="Post has approved successfully";
            Redirect_to("dashboard");

        }else{
            $_SESSION["ErrorMessage"]="Something went wrong! Try Again!!";
            Redirect_to("dashboard");
        }
    }else{
        // $_SESSION["ErrorMessage"]=$_SESSION['UserType'];
        Redirect_to("dashboard");
    }
}


?>