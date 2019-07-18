<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<!DOCTYPE>

<html>
    <head>
        <title>Portal Page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/publicstyles.css">
    </head>
    <body>
<div style="height: 10px;background: #27aae1;"></div>
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
        <div class="container">
            <div class="blog header">
            <h1>Threat Intelligence Platform</h1>
            </div>
        <div class="row">
            <div class="col-sm-8">
            <?php
            global $connection;
            if(isset($_GET["SearchButton"])){
                $Search=$_GET["Search"];
                $ViewQuery="SELECT * FROM admin_panel 
                WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
                OR category LIKE '%$Search%' or post LIKE '%$Search$'";    
            }
            else{
            $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";}
            $Execute=mysqli_query($connection,$ViewQuery);
            while($DataRows=mysqli_fetch_array($Execute)){
                $postId=$DataRows["id"];
                $DateTime=$DataRows["datetime"];
                $Title=$DataRows["title"];
                $Category=$DataRows["category"];
                $Admin=$DataRows["author"];
                $Image=$DataRows["image"];
                $Post=$DataRows["post"];
            
            ?>
            <div class="blogpost thumbnail">
                <img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>">
            <div class="caption">
                    <h1 id="heading"><?php echo htmlentities($Title); ?></h1>
            <p class="description">Category:<?php echo htmlentities($Category); ?> Published on:
            <?php echo htmlentities($DateTime); ?> </p>  
            <p class="post"><?php 
            if(strlen($Post)>150){$Post=substr($Post,0,150).'...';}
            
            echo $Post; ?> </p>  
            </div>
            <a href="FullPost.php?id=<?php echo $postId; ?>"><span class="btn btn-info">
                Read More &rsaquo;</span></a>
            </div>
            <?php } ?>
            </div><!--Main area ending-->
            <div class="col-sm-offset-1 col-sm-3">
            <h2>Test</h2>
            <p>Lorem ipsum dolor sit amet, <em>consectetur adipiscing elit</em>, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            </div><!--Side area ending-->
        </div><!--Row Ending-->
</div><!--Container Ending-->
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