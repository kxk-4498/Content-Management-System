<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["Submit"])){
    global $connection;
    $Username=mysqli_real_escape_string($connection,$_POST["Username"]);
    $Password=mysqli_real_escape_string($connection,$_POST["Password"]);
    if(empty($Username)||empty($Password)){
        $_SESSION["ErrorMessage"]="All feilds must be filled out";
        Redirect_to("login");
    }
    else{
        $Found_Account=Login_Attempt($Username,$Password);
        $_SESSION["User_Id"]=$Found_Account["id"];
        $_SESSION["Username"]=$Found_Account["username"];
        $_SESSION['UserType']=$Found_Account['user_type'];
        if($Found_Account){
            if($Found_Account["user_type"]==0){
                $_SESSION["SuccessMessage"]="Welcome {$_SESSION["Username"]}";
                Redirect_to("dashboard");
            }elseif($Found_Account["user_type"]==1){
                $_SESSION["SuccessMessage"]="Welcome {$_SESSION["Username"]}";
                Redirect_to("auther_dashboard");
            }
            

        }else{
            $_SESSION["ErrorMessage"]="Invalid Email or Password!".$Password;
            Redirect_to("login");

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
        .FieldInfo{
                color: rgb(251,174,44);
                font-family: Bitter,Georgia,Times,"Times New Roman",serif;
                font-size: 1.2em;
            }
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
        <a class="navbar-brand" href="portal">
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
        <form action="Login.php" method="post">
        <fieldset>
            <div class="form-group">
            <label for="Username"><span class="FieldInfo">Username:</span></label>
            <div class="input-group input-group-lg">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-envelope text-primary" ></span>
            </span>
            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
            </div>
            </div>
            <div class="form-group">
            <label for="Password"><span class="FieldInfo">Password:</span></label>
            <div class="input-group input-group-lg">
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-lock text-primary" ></span>
            </span>
            <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
            </div>
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