<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_GET["id"])){
    global $connection;
    $IDFromURL=$_GET["id"];
    $Query="DELETE FROM comments WHERE id='$IDFromURL'";
    $Execute=mysqli_query($connection,$Query);
    if($Execute){
        $_SESSION["SuccessMessage"]="Comment Deleted successfully";
        Redirect_to("Comments.php");

    }else{
        $_SESSION["ErrorMessage"]="Something went wrong! Try Again!!";
        Redirect_to("Comments.php");

}



}


?>