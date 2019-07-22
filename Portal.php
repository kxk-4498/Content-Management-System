<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<!DOCTYPE>

<html>
    <head>
        <title>Portal</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/publicstyles.css">
    </head>
    <body>
<!-- <div style="height: 12px;background: #27aae1;"></div> -->
<nav class ="navbar navbar-inverse navbar-default" role="navigation">
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
        <ul class="nav navbar-nav">
            <!-- <li><a href="#">Home</a></li> -->
            <li class="active"><a href="portal">Home</a></li>
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
                        echo "<li><a href='portal?Search=".$CategoryName."&page='>".$CategoryName."</a></li>";
                    }
            ?>
            </ul>
            </li>            
            <!-- <li><a href="#">Contact Us</a></li> -->
            <li><a href="#">Feature</a></li>
        </ul>
        <form method="POST" action="portal" class="navbar-form navbar-right">
        <div class="form-group"> 
        <input type="text" class="form-control" placeholder="Search" name="Search">
        </div>
        <button class="btn btn-default" name="SearchButton">Go</button>
        </form>
        </div>
        <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="login">Login</a></li> -->
        </ul>
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
            //query when search button active
            if(isset($_REQUEST["SearchButton"])){
                $Search=mysqli_real_escape_string($connection, $_REQUEST["Search"]);
                $ViewQuery="SELECT * FROM admin_panel 
                WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
                OR category LIKE '%$Search%' or post LIKE '%$Search$'";    
            }//query when pagination active
            elseif(isset($_REQUEST["page"])){
                $Page=$_REQUEST["page"];
                if($Page==0||$Page<-1)
                {
                    $ShowPostFrom=0;
                }else{
                $ShowPostFrom=($Page*5)-5;
                }
                $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $ShowPostFrom,5";
            }//query for showing portal contents
            else{
            Redirect_to('portal?page=1');
            $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";}
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
            <div id="share-buttons">
                <!-- Facebook -->
                <a href="http://www.facebook.com/sharer.php?u=https://mahacyber.com&amp;fullPost?id=<?php echo $postId?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                </a>
                <!-- Twitter -->
                <a href="https://twitter.com/share?url=https://mahacyber.com&amp;fullPost?id=<?php echo $postId?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                </a>
                
                <!-- Google+ -->
                <a href="https://plus.google.com/share?url=https://mahacyber.com&amp;fullPost?id=<?php echo $postId?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
                </a>
                
                <!-- LinkedIn -->
                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://mahacyber.com&amp;fullPost?id=<?php echo $postId?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                </a>
            </div>
            <!-- <span class="glyphicon glyphicon-share" aria-hidden="true"></span> -->
            <a href="fullPost?id=<?php echo $postId; ?>"><span class="btn btn-info">
                Read More &rsaquo;</span></a>
            </div>
            <?php } ?>
            <nav>
            <ul class="pagination pull left pagination-lg">
                 <!-- code for Backward button-->
                <?php
                if(isset($Page))
                {
                if($Page>1){
                    ?>
                    <li><a href="portal?Page=<?php echo $Page-1; ?>">&laquo;</a></li>
                <?php }?>

              <?php  } ?>
            <?php
            global $connection;
            $QueryPagination="SELECT COUNT(*) FROM admin_panel";
            $ExecutePagination=mysqli_query($connection,$QueryPagination);
            $RowPagination=mysqli_fetch_array($ExecutePagination);
            $TotalPosts=array_shift($RowPagination);
            //echo $TotalPosts;
            $PostsPerPage=$TotalPosts/5;
            $PostsPerPage=ceil($PostsPerPage);
            //echo $PostsPerPage;
            for($i=1;$i<=$PostsPerPage;$i++)
            {
                if(isset($Page)){
                if($i==$Page){

            ?>

            <li class="active"><a href="portal?page=<?php echo $i;?>"><?php echo $i;?></a></li>
            <?php 
            }else{?>
                <li><a href="portal?page=<?php echo $i;?>"><?php echo $i;?></a></li>
        <?php
        }
     }
     } ?>
     <!-- code for forward button-->
      <?php
                if(isset($Page))
                {
                if($Page+1<=$PostsPerPage){
                    ?>
                    <li><a href="portal?page=<?php echo $Page+1; ?>">&raquo;</a></li>
                <?php }?>

              <?php  } ?>
            </ul>
            </nav>


            </div><!--Main area ending-->
            <div class="col-sm-offset-1 col-sm-3">
            <h2>Maharashtra Cyber</h2>
            <img class="img-responsive imageicon" src="images/mahapolice.png">
            <p>Maharashtra Cyber ​is a nodal agency established by the Government of Maharashtra to tackle cyber crimes and other digital threats. It is engaged in building Cyber Infrastructure for Maharashtra, including Cyber Police Stations, anti-piracy systems, predictive policing systems, awareness about cyber crimesand initiatives, etc.</p>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
            <h2 class="panel-title">Category</h2>
            </div>
            <div class="panel-body background">
                <?php
                global $connection;
                $ViewQuery="SELECT * FROM category ORDER BY datetime desc";
                $Execute=mysqli_query($connection,$ViewQuery);
                while($DataRows=mysqli_fetch_array($Execute)){
                    $Id=$DataRows["id"];
                    $Category=$DataRows["name"];
                
                ?>
                <a href="portal?Search=<?php echo $Category; ?>&SearchButton=">
                <span id="heading"><?php echo $Category."<br>";?></span>
                </a>
                <div class="panel-footer"> </div>
                <?php }?>
            
            </div>
            
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading">
            <h2 class="panel-title">Recent Posts</h2>
            </div>
            <div class="panel-body background">
                <?php
                 global $connection;
                $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
            $Execute=mysqli_query($connection,$ViewQuery);
            while($DataRows=mysqli_fetch_array($Execute)){
                $postId=$DataRows["id"];
                $DateTime=$DataRows["datetime"];
                $Title=$DataRows["title"];
                $Image=$DataRows["image"];
                if(strlen($DateTime)>12){$DateTime=substr($DateTime,0,12);}
            
            ?>
            <div>
                <img class="pull-left" style="margin-top: 10px; margin-left: 10px;" src="Upload/<?php echo htmlentities($Image); ?>" width=70; height=50;>
                <a href="fullPost?id=<?php echo $postId; ?>">
                    <p id="heading" style=" margin-left: 90px;"><?php echo htmlentities($Title); ?></p>
            </a>
            <p class="description"  style=" margin-left: 90px;"><?php echo htmlentities($DateTime); ?></p>
            <hr>    
            </div>
            <?php } ?>
            
            </div>
            <div class="panel-footer">
            
            </div>
        </div>

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