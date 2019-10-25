<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login(); ?>
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
    $Admin=$_SESSION["Username"];
    $Image=$_FILES["Image"]["name"];
    $Target="Upload/".basename($_FILES["Image"]["name"]);
    if(empty($Title)){
        $_SESSION["ErrorMessage"]="Title can't be empty!";
        Redirect_to("editPost");
    }elseif(strlen($Title)<4){
        $_SESSION["ErrorMessage"]="Title should be more than 3 characters";
        Redirect_to("editPost");
    }else{
        global $connection;
        $EditFromURL=$_GET['Edit'];
        $Query="UPDATE admin_panel SET datetime='$DateTime',title='$Title',category='$Category',
        author='$Admin',image='$Image',post='$Post'
        WHERE id='$EditFromURL'";
        $Execute=mysqli_query($connection,$Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if($Execute){
            $_SESSION["SuccessMessage"]="Post Updated successfully";
            Redirect_to("dashboard");

        }else{
            $_SESSION["ErrorMessage"]="Something went wrong!";
            Redirect_to("dashboard");

    }
}

}

?>

<!DOCTYPE>

<html>
    <head>
        <title>Edit Post</title>
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
            <li class="active"><a href="Portal.php">Home</a></li>
            <!--<li ><a href="portal" target="_blank">Portal</a></li>
            <li><a href="aboutus">About Us</a></li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Services <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <?php
                    global $connection;
                    $ViewQuery="SELECT * FROM category ORDER BY datetime desc";
                    $Execute=mysqli_query($connection,$ViewQuery);
                    while($DataRows=mysqli_fetch_array($Execute)){
                        $Id=$DataRows["id"];
                        $CategoryName=$DataRows["name"];
                        echo "<li><a href='portal?Search=".$CategoryName."&SearchButton='>".$CategoryName."</a></li>";
                    }
            ?>
            </ul>
            </li> -->           
            <!-- <li><a href="#">Contact Us</a></li> -->
            <!--<li><a href="#">Feature</a></li>-->
        </ul>
        </nav>
        <div class="Line" style="height: 10px;background: #27AAE1;"></div>
<div class="container-fuid">
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
        <li class="active"><a href="editPost">
        <span class="glyphicon glyphicon-list-alt"></span>
        &nbsp;Edit Post</a></li>
        <li><a href="manageAdmin">
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
        <!--<li><a href="#">
        <span class="glyphicon glyphicon-equalizer"></span>
        &nbsp;Live Blog</a></li>-->
        <li><a href="logout">
        <span class="glyphicon glyphicon-log-out"></span>
        &nbsp;Logout</a></li>
        
        

        </ul>
        </div><!--Ending of side area-->
        <div class="col-sm-10">
        <h1>Update Post</h1>
        <div><?php  echo Message();
                    echo SuccessMessage();
         ?>
        <div>
        <?php
                    global $connection;
            $SearchQueryParameter=mysqli_real_escape_string($connection,$_REQUEST['Edit']);
            $ViewQuery="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
            $Execute=mysqli_query($connection,$ViewQuery);
            $TitleUpdate=NULL;
            $CategoryUpdate=NULL;
            $ImageUpdate=NULL;
            $PostUpdate=NULL;
            while($DataRows=mysqli_fetch_array($Execute)){
                $TitleUpdate=$DataRows['title'];
                $CategoryUpdate=$DataRows["category"];
                $ImageUpdate=$DataRows["image"];
                $PostUpdate=$DataRows["post"]; 
            }
            
            ?>
        <form action="editPost?Edit=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
            <label for="title"><span class="FieldInfo">Title:</span></label>
            <input value="<?php echo $TitleUpdate; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
            <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
            <span class="FieldInfo">Existing Category:</span>
            <?php echo $CategoryUpdate; ?>
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
            <span class="FieldInfo">Existing Image:</span>
            <img src="upload/<?php echo $ImageUpdate; ?>"width=170; height=70px;>
            <input type="File" class="form-control" name="Image" id="imageselect">
            </div>
            <div class="form-group">
            <label for="postarea"><span class="FieldInfo">Post:</span></label>
            <textarea class="form-control" name="Post" id="postarea">
            <?php echo $PostUpdate;  ?>
            </textarea>
            </div>
            <br>
            <input class="btn btn-success btn-lg"type="Submit" name="Submit" value="Update Post">
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