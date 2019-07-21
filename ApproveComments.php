<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login(); ?>
<?php
if(isset($_GET["id"])){
    global $connection;
    $IdFromURL=mysqli_real_escape_string($connection, $_REQUEST["id"]);
    $Admin=$_SESSION["Username"];
    $Query="UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$IdFromURL'";
    $Execute=mysqli_query($connection,$Query);
    if($Execute){
        $_SESSION["SuccessMessage"]="Comment Approved successfully";
        Redirect_to("Comments.php");

    }else{
        $_SESSION["ErrorMessage"]="Something went wrong! Try Again!!";
        Redirect_to("Comments.php");

}



}


?>