 <?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login();
Confirm_Admin();
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

<div class="container-fluid">
<div class="row">


    <div class="col-sm-2">
    <br><br>
        <ul id="Side_Menu" class="nav nav-pills nav-stacked">
        <li class="active"><a href="dashboard">
        <span class="glyphicon glyphicon-th"></span>
        &nbsp;Dashboard</a></li>
        <li><a href="categories">
        <span class="glyphicon glyphicon-tags"></span>
        &nbsp;Categories</a></li>
        <li><a href="addNewPost">
        <span class="glyphicon glyphicon-list-alt"></span>
        &nbsp;Add New Post</a></li>
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
        <div><?php  echo Message();
                    echo SuccessMessage();
         ?></div>
        <h1>Admin Dashboard</h1>
        
        <div class="table-responsive">
         <table class="table table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Post Title</th>
                <th>Date & TIme</th>
                <th>Author</th>
                <th>Category </th>
                <th>Banner</th>
                <th>Comments</th>
                <th>Actions</th>
                <th>Details</th>
    
    
            </tr>
            <?php
            global $connection;
            $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";
            $Execute=mysqli_query($connection,$ViewQuery);
            $SrNo=0;
            while($DataRows=mysqli_fetch_array($Execute)){
                $Id=$DataRows["id"];
                $DateTime=$DataRows["datetime"];
                $Title=$DataRows["title"];
                $Category=$DataRows["category"];
                $Admin=$DataRows["author"];
                $status=$DataRows["status"];
                $Image=$DataRows["image"];
                $Post=$DataRows["post"];
                $SrNo++;
            
            ?>
            <tr>
            <td><?php echo $SrNo;?></td>
            <td style="color: #5e5eff;"><?php 
            if(strlen($Title)>10){$Title=substr($Title,0,10)."...";}
            echo $Title;?></td>
            <td><?php 
            if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,12)."...";}
            echo $DateTime;?></td>
            <td><?php 
             if(strlen($Admin)>8){$Admin=substr($Admin,0,8)."...";}
            echo $Admin;?></td>
            <td><?php
            if(strlen($Category)>10){$Category=substr($Category,0,10)."...";}
            echo  $Category;?></td>
            <td><img src="upload/<?php echo $Image;?>" width="100";height="30px"></td>
            <td>
                <?php
                     global $connection;
                     $QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id'AND status='ON'";
                     $QueryDisApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id'AND status='OFF'";
                     $ExecuteApproved=mysqli_query($connection,$QueryApproved);
                     $ExecuteDisApproved=mysqli_query($connection,$QueryDisApproved);
                     $RowsApproved=mysqli_fetch_array($ExecuteApproved);
                     $RowsDisApproved=mysqli_fetch_array($ExecuteDisApproved);
                     $TotalDisApproved=array_shift($RowsDisApproved);
                     $TotalApproved=array_shift($RowsApproved);
                ?>
                <span class="label pull-left label-danger">
                <?php echo $TotalDisApproved; ?></span>
                <span class="label pull-right label-success">
                <?php echo $TotalApproved; ?></span>
            
            
            
            
            </td>
            <td>
            <?php if($status=="0"){ ?>
            <a href="approve_post?id=<?php echo $Id;?>">
            <span class="btn btn-success">Approve</span>
            </a> <?php } ?>
            <a href="editPost?Edit=<?php echo $Id;?>">
            <span class="btn btn-warning">Edit</span>
            </a>
            <a href="deletePost?Delete=<?php echo $Id;?>">
            <span class="btn btn-danger">Delete</span>
            </a>
            </td>
            <td><a href="fullPost?id=<?php echo $Id;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></td></a>

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