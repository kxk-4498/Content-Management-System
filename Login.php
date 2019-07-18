 <?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["Submit"])){
    global $connection;
    $Username=mysqli_real_escape_string($connection,$_POST["Username"]);
    $Password=mysqli_real_escape_string($connection,$_POST["Password"]);
    $ConfirmPassword=mysqli_real_escape_string($connection,$_POST["ConfirmPassword"]);
    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $Admin="Kaustubh Kumar";
    if(empty($Username)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]="all feilds must be filled out";
        Redirect_to("ManageAdmin.php");
    }elseif(strlen($Password)<4){
        $_SESSION["ErrorMessage"]="Atleast 4 characters of password required!";
        Redirect_to("ManageAdmin.php");
    }elseif($Password!==$ConfirmPassword){
         $_SESSION["ErrorMessage"]="Password/Confirm Password does not match!";
        Redirect_to("ManageAdmin.php");
    }else{
        global $connection;
        $Query="INSERT INTO admin_registration(datetime,username,password,addedby)
        VALUES('$DateTime','$Username','$Password','$Admin')";
        $Execute=mysqli_query($connection,$Query);
        if($Execute){
            $_SESSION["SuccessMessage"]="Admin added successfully";
            Redirect_to("ManageAdmin.php");

        }else{
            $_SESSION["ErrorMessage"]="Admin failed to add";
            Redirect_to("ManageAdmin.php");

    }
}

}

?>

<!DOCTYPE>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/adminstyle.css">
        <style>
        .navbar-nav li{
    font-family: Bitter,Georgia,Times,"Times New Roman",serif;
    font-size: 1.2em;
}
.Line{
    margin-top: -20px;
}
body{
    background-color: #ffffff;
}
        </style>
    </head>
    <body>
    <div style="height: 10px;background: #27AAE1;"></div>
<nav class ="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="Portal.php">
        <img style="margin-top: -12px;" src="images/maha.jfif" width=40;height=7;>
        </a>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
        
        </div>
        </nav>
        <div class="Line" style="height: 10px;background: #27AAE1;"></div>

<div class="container-fluid">
<div class="row">


        <div class="col-sm-offset-4 col-sm-4">
        <br><br><br><br>
        <div><?php  echo Message();
                    echo SuccessMessage();
         ?></div>
        <h2>Welcome Back!</h2>
        <div>
        <form action="ManageAdmin.php" method="post">
        <fieldset>
            <div class="form-group">
            <label for="Username"><span>Username:</span></label>
            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
            </div>
            <div class="form-group">
            <label for="Password"><span>Password:</span></label>
            <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
            </div>
            <br>
            <input class="btn btn-info btn-block"type="Submit" name="Submit" value="Login">
        </fieldset>
        <br>
        </form>
        </div>
        
        </div><!--Ending of Main area-->

</div><!--Ending of Row-->
</div><!--Ending of Container-->




    </body>

</html> 