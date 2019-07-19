<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_REQUEST["id"])){
    global $connection;
    $IdFromURL=mysqli_real_escape_string($connection, $_REQUEST["id"]);
    $Query="DELETE FROM admin_registration WHERE id='$IdFromURL'";
    $Execute=mysqli_query($connection,$Query);
    if($Execute){
        $_SESSION["SuccessMessage"]="Admin deleted successfully";
        Redirect_to("ManageAdmin.php");

    }else{
        $_SESSION["ErrorMessage"]="Admin failed to delete";
        Redirect_to("ManageAdmin.php");

}
}
?>