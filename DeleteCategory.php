<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login(); ?>
<?php
if(isset($_GET["id"])){
    global $connection;
    $IdFromURL=mysqli_real_escape_string($connection, $_REQUEST["id"]);
    $Query="DELETE FROM Category WHERE id='$IdFromURL'";
    $Execute=mysqli_query($connection,$Query);
    if($Execute){
        $_SESSION["SuccessMessage"]="category deleted successfully";
        Redirect_to("Categories.php");

    }else{
        $_SESSION["ErrorMessage"]="Category failed to delete";
        Redirect_to("Categories.php");

}
}
?>