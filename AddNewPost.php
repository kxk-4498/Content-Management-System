<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["Submit"])){
    global $connection;
    $Title=mysqli_real_escape_string($connection,$_POST["Title"]);
    $Category=mysqli_real_escape_string($connection,$_POST["Category"]);
    $Post=mysqli_real_escape_string($connection,$_POST["Post"]);
    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $Admin="Kaustubh Kumar";
    $Image=$_FILES["Image"]["name"];
    $Target="Upload/".basename($_FILES["Image"]["name"]);
    if(empty($Title)){
        $_SESSION["ErrorMessage"]="Title can't be empty!";
        Redirect_to("AddNewPost.php");
    }elseif(strlen($Title)<4){
        $_SESSION["ErrorMessage"]="Title should be more than 3 characters";
        Redirect_to("AddNewPost.php");
    }else{
        global $connection;
        $Query="INSERT INTO admin_panel(datetime,title,category,author,image,post)
        VALUES('$DateTime','$Category','$Title','$Admin','$Image','$Post')";
        $Execute=mysqli_query($connection,$Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if($Execute){
            $_SESSION["SuccessMessage"]="Post added successfully";
            Redirect_to("AddNewPost.php");

        }else{
            $_SESSION["ErrorMessage"]="Something went wrong!";
            Redirect_to("AddNewPost.php");

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
.FeildInfo{
    
}
<style>
        .navbar-nav li{
    font-family: Bitter,Georgia,Times,"Times New Roman",serif;
    font-size: 1.2em;
}
.Line{
    margin-top: -20px;
}
        </style>
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
            <li class="active"><a href="Portal.php">Portal</a></li>
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
<div class="container-fuid">
<div class="row">
    <div class="col-sm-2">
    <br><br>
        <ul id="Side_Menu" class="nav nav-pills nav-stacked">
        <li><a href="Dashboard.php">
        <span class="glyphicon glyphicon-th"></span>
        &nbsp;Dashboard</a></li>
        <li><a href="Categories.php">
        <span class="glyphicon glyphicon-tags"></span>
        &nbsp;Categories</a></li>
        <li class="active"><a href="AddNewPost.php">
        <span class="glyphicon glyphicon-list-alt"></span>
        &nbsp;Add New Post</a></li>
        <li><a href="ManageAdmin.php">
        <span class="glyphicon glyphicon-user"></span>
        &nbsp;Manage Admins</a></li>
        <li><a href="Comments.php">
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
        <li><a href="#">
        <span class="glyphicon glyphicon-log-out"></span>
        &nbsp;Logout</a></li>
        
        

        </ul>
        </div><!--Ending of side area-->
        <div class="col-sm-10">
        <h1>Add New Post</h1>
        <div><?php  echo Message();
                    echo SuccessMessage();
         ?>
        <div>
        <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
            <label for="title"><span class="FieldInfo">Title:</span></label>
            <input class="form-control" type="text" name="Title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
            <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
            <select class ="form-control" id="categoryselect" name="Category">
            <?php
global $connection;
$ViewQuery="SELECT * FROM category ORDER BY datetime desc";
$Execute=mysqli_query($connection,$ViewQuery);
while($DataRows=mysqli_fetch_array($Execute)){
    $Id=$DataRows["id"];
    $CategoryName=$DataRows["name"];


?>
            <option><?php echo $CategoryName; ?></option>
<?php } ?>
            </select>
            </div>
            <div class="form-group">
            <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
            <input type="File" class="form-control" name="Image" id="imageselect">
            </div>
            <div class="form-group">
            <label for="postarea"><span class="FieldInfo">Post:</span></label>
            <textarea class="form-control" name="Post" id="postarea"></textarea>
            </div>
            <br>
            <input class="btn btn-success btn-lg"type="Submit" name="Submit" value="Add New Post">
        </fieldset>
        <br>
        </form>
        </div>



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