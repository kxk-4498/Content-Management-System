<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>


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
        <li><a href="Dashboard.php">
        <span class="glyphicon glyphicon-th"></span>
        &nbsp;Dashboard</a></li>
        <li><a href="Categories.php">
        <span class="glyphicon glyphicon-tags"></span>
        &nbsp;Categories</a></li>
        <li><a href="AddNewPost.php">
        <span class="glyphicon glyphicon-list-alt"></span>
        &nbsp;Add New Post</a></li>
        <li><a href="ManageAdmin.php">
        <span class="glyphicon glyphicon-user"></span>
        &nbsp;Manage Admins</a></li>
        <li class="active"><a href="Comments.php">
        <span class="glyphicon glyphicon-comment"></span>
        &nbsp;Comments</a></li>
        <li><a href="#">
        <span class="glyphicon glyphicon-equalizer"></span>
        &nbsp;Live Blog</a></li>
        <li><a href="#">
        <span class="glyphicon glyphicon-log-out"></span>
        &nbsp;Logout</a></li>
        
        

        </ul>
        </div><!--Ending of side area-->
        <div class="col-sm-10">
        <div><?php  echo Message();
                    echo SuccessMessage();
         ?></div>
        <h1>Un-Approved Comments</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Dis-Approved By</th>
                <th>Approve</th>
                <th>Delete Comment</th>
                <th>Details</th>
                </tr>
                <?php
                 global $connection;
                 $ViewQuery="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
                 $Execute=mysqli_query($connection,$ViewQuery);
                 $Admin="Kaustubh Kumar";
                 $SrNo=0;
                 while($DataRows=mysqli_fetch_array($Execute)){
                    $CommentId=$DataRows["id"];
                    $DateTimeofComment=$DataRows["datetime"];
                    $PersonName=$DataRows["name"];
                    $PersonComments=$DataRows["comment"];
                    $CommentedPostId=$DataRows["admin_panel_id"];
                    $SrNo++; 
                
                
                
                ?>
                <tr>
                    <td><?php echo htmlentities($SrNo);?></td>
                    <td style="color: #5e5eff;"><?php 
                     if(strlen($PersonName)>20){$PersonName=substr($Title,0,20)."...";}
                    echo htmlentities($PersonName);?></td>
                    <td><?php 
                    if(strlen($DateTimeofComment)>11){$DateTimeofComment=substr($DateTimeofComment,0,12)."...";}
                    echo htmlentities($DateTimeofComment);?>.</td>
                    <td><?php 
                    if(strlen($PersonComments)>20){$PersonComments=substr($PersonComments,0,20)."...";}
                    echo htmlentities($PersonComments);?></td>
                    <td><?php echo $Admin; ?></td>
                    <td>
                    <a href="ApproveComments.php?id=<?php echo $CommentId;?>">
                    <span class="btn btn-success">Approve</span>
                    </a></td>
                    <td>
                    <a href="DeleteComments.php?id=<?php echo $CommentId;?>">
                    <span class="btn btn-danger">Delete</span>
                    </a>
                    </td>
                    <td><a href="FullPost.php?id=<?php echo $CommentedPostId;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></td></a>
                    </tr>


                 <?php } ?>
            </table>
        </div>

        <h1>Approved Comments</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Approved By</th>
                <th>Revert Approve</th>
                <th>Delete Comment</th>
                <th>Details</th>
                </tr>
                <?php
                 global $connection;
                 $ViewQuery="SELECT * FROM comments WHERE status='ON' ORDER BY datetime desc";
                 $Execute=mysqli_query($connection,$ViewQuery);
                 $Admin="Kaustubh Kumar";
                 $SrNo=0;
                 while($DataRows=mysqli_fetch_array($Execute)){
                    $CommentId=$DataRows["id"];
                    $DateTimeofComment=$DataRows["datetime"];
                    $PersonName=$DataRows["name"];
                    $PersonComments=$DataRows["comment"];
                    $CommentedPostId=$DataRows["admin_panel_id"];
                    $SrNo++; 
                
                
                
                ?>
                <tr>
                    <td><?php echo htmlentities($SrNo);?></td>
                    <td style="color: #5e5eff;"><?php 
                    if(strlen($PersonName)>20){$PersonName=substr($Title,0,20)."...";}
                    echo htmlentities($PersonName);?></td>
                    <td><?php
                    if(strlen($DateTimeofComment)>11){$DateTimeofComment=substr($DateTimeofComment,0,12)."...";}
                    echo htmlentities($DateTimeofComment);?>.</td>
                    <td><?php 
                    if(strlen($PersonComments)>20){$PersonComments=substr($PersonComments,0,20)."...";}
                    echo htmlentities($PersonComments);?></td>
                    <td><?php echo $Admin; ?></td>
                    <td>
                    <a href=DisApproveComments.php?id=<?php echo $CommentId;?>">
                    <span class="btn btn-warning">Dis-Approve</span>
                    </a></td>
                    <td>
                    <a href="DeleteComments.php?id=<?php echo $CommentId;?>">
                    <span class="btn btn-danger">Delete</span>
                    </a>
                    </td>
                    <td><a href="FullPost.php?id=<?php echo $CommentedPostId;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></td></a>
                    </tr>


                 <?php } ?>
            </table>
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