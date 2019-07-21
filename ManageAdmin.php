 <?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php 
Confirm_Login();
Confirm_Admin();
?>
<?php

if(isset($_POST["Submit"])){
    if(!empty($_REQUEST['csrf_token'])){
        if( checkToken($_REQUEST['csrf_token'], 'protectedManageAdmin')) {
            global $connection;
            $Username=mysqli_real_escape_string($connection,$_POST["Username"]);
            $Username=htmlentities(htmlspecialchars($Username, ENT_COMPAT,'ISO-8859-1', true),ENT_COMPAT,'ISO-8859-1', true); // xss protection
            $Password=mysqli_real_escape_string($connection,$_POST["Password"]);
            $Password=htmlentities(htmlspecialchars($Password, ENT_COMPAT,'ISO-8859-1', true),ENT_COMPAT,'ISO-8859-1', true); // xss protection
            $ConfirmPassword=mysqli_real_escape_string($connection,$_POST["ConfirmPassword"]);
            $ConfirmPassword=htmlentities(htmlspecialchars($ConfirmPassword, ENT_COMPAT,'ISO-8859-1', true),ENT_COMPAT,'ISO-8859-1', true); // xss protection
        
            date_default_timezone_set("Asia/Kolkata");
            $CurrentTime=time();
            $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
            $DateTime;
            $Admin=$_SESSION["Username"];
            if(empty($Username)||empty($Password)||empty($ConfirmPassword)){
                $_SESSION["ErrorMessage"]="all feilds must be filled out";
                Redirect_to("manageAdmin");
            }elseif(strlen($Password)<4){
                $_SESSION["ErrorMessage"]="Atleast 4 characters of password required!";
                Redirect_to("manageAdmin");
            }elseif($Password!==$ConfirmPassword){
                 $_SESSION["ErrorMessage"]="Password/Confirm Password does not match!";
                Redirect_to("manageAdmin");
            }else{
                global $connection;
                $Query="INSERT INTO admin_registration(datetime,username,password,addedby)
                VALUES('$DateTime','$Username','$Password','$Admin')";
                $Execute=mysqli_query($connection,$Query);
                if($Execute){
                    $_SESSION["SuccessMessage"]="Admin added successfully";
                    Redirect_to("manageAdmin");
        
                }else{
                    $_SESSION["ErrorMessage"]="Admin failed to add";
                    Redirect_to("manageAdmin");
        
                }
            }
        }
    }
}

?>

<!DOCTYPE>

<html>
    <head>
        <title>Admin Dashboard</title>
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
        <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li class="active"><a href="Portal.php" target="_blank">Portal</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Feature</a></li>
        </ul>
        <form action="Portal.php" class="navbar-form navbar-right">
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="Search">
        </div>
        <button class="btn btn-default" name="SearchButton">Go</button>
        </form>
        </div>
        </nav>
        <div class="Line" style="height: 10px;background: #27AAE1;"></div>

<div class="container-fluid">
<div class="row">


    <div class="col-sm-2">
    <br><br>
        <ul id="Side_Menu" class="nav nav-pills nav-stacked">
        <li><a href="dashboard">
        <span class="glyphicon glyphicon-th"></span>
        &nbsp;Dashboard</a></li>
        <li><a href="categories">
        <span class="glyphicon glyphicon-tags"></span>
        &nbsp;Categories</a></li>
        <li><a href="addNewPost">
        <span class="glyphicon glyphicon-list-alt"></span>
        &nbsp;Add New Post</a></li>
        <li class="active"><a href="manageAdmin">
        <span class="glyphicon glyphicon-user"></span>
        &nbsp;Manage Admins</a></li>
        <li><a href="comments">
        <span class="glyphicon glyphicon-comment"></span>
        &nbsp;Comments
        <?php
                     global $connection;
                     $QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
                     $ExecuteTotal=mysqli_query($connection,$QueryTotal);
                     $RowsTotal=mysqli_fetch_array($ExecuteTotal);
                     $TotalUnApprovedComments=array_shift($RowsTotal);
                ?>
                <span class="label pull-right label-warning">
                <?php echo $TotalUnApprovedComments; ?></span>
            
        </a></li>
        <li><a href="#">
        <span class="glyphicon glyphicon-equalizer"></span>
        &nbsp;Live Blog</a></li>
        <li><a href="logout">
        <span class="glyphicon glyphicon-log-out"></span>
        &nbsp;Logout</a></li>
        
        

        </ul>
        </div><!--Ending of side area-->
        <div class="col-sm-10">
        <h1>Manage Admin Access</h1>
        <div><?php  echo Message();
                    echo SuccessMessage();
         ?></div>
        <div>
        <form action="manageAdmin" method="post">
        <fieldset>
            <div class="form-group">
            <label for="Username"><span>Username:</span></label>
            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
            </div>
            <div class="form-group">
            <label for="Password"><span>Password:</span></label>
            <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
            </div>
            <div class="form-group">
            <label for="ConfirmPassword"><span>Confirm Password:</span></label>
            <input type="hidden" name="csrf_token" value="<?php echo generateToken('protectedManageAdmin'); ?>"/>
            <input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Retype Same Password">
            </div>
            <br>
            <input class="btn btn-success btn-lg"type="Submit" name="Submit" value="Add New Admin">
        </fieldset>
        <br>
        </form>
        </div>
        <div class="table-responsive">
         <table class="table table-striped table-hover">
    <tr>
        <th>Sr No.</th>
        <th>Date & TIme</th>
        <th>Username</th>
        <th>Added By</th>
        <th>Action</th>
    
    
    </tr>
<?php
global $connection;
$ViewQuery="SELECT * FROM admin_registration ORDER BY datetime desc";
$Execute=mysqli_query($connection,$ViewQuery);
$SrNo=0;
while($DataRows=mysqli_fetch_array($Execute)){
    $Id=$DataRows["id"];
    $DateTime=$DataRows["datetime"];
    $AdminName=$DataRows["username"];
    $AddedBy=$DataRows["addedby"]; 
    $SrNo++;


?>
<tr>
        <td><?php echo $SrNo;?></td>
        <td><?php echo $DateTime;?></td>
        <td><?php echo $AdminName;?>.</td>
        <td><?php echo $AddedBy;?></td>
        <td><a href="deleteAdmin?id=<?php echo $Id;?>">
        <span class="btn btn-danger">Delete</span>
        
</a>
</td>

</tr>
<?php } ?>
    </table>
        </div><!--Ending of Main area-->

</div><!--Ending of Row-->
</div><!--Ending of Container-->
<div id="Footer">
    <hr><p>Theme by | Maharashtra Cyber |&copy;2019 --- All rights reserved.
</p>
<a style="color: white; text-decoration:none; cursor: pointer; font weight: bold" href="https://www.reportphishing.in/index.php" target="_blank">
<p>This site is a cyber crime advisory knowledge portal made by &trade;Maharashtra Cyber.Maharashtra Cyber holds all the possession and rights over the contents of this portal.
    All findings are published and are for everyone in advisory and for general public as well.
</p><hr></a>
</div>
<div style="height: 10px; background: #27AAE1;"></div>



    </body>

</html> 