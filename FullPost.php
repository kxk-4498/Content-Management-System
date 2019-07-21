<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>

<?php
if(isset($_POST["Submit"])){
    if(!empty($_REQUEST['csrf_token'])){
        if( checkToken($_REQUEST['csrf_token'], 'protectedComment')) {
            global $connection;
            $Name=mysqli_real_escape_string($connection,$_POST["Name"]);
            $Name=htmlentities(htmlspecialchars($Name, ENT_COMPAT,'ISO-8859-1', true),ENT_COMPAT,'ISO-8859-1', true); // xss protection
            $Email=mysqli_real_escape_string($connection,$_POST["Email"]);
            $Email=htmlentities(htmlspecialchars($Email, ENT_COMPAT,'ISO-8859-1', true),ENT_COMPAT,'ISO-8859-1', true); // xss protection
            $Comment=mysqli_real_escape_string($connection,$_POST["Comment"]);
            $Comment=htmlentities(htmlspecialchars($Comment, ENT_COMPAT,'ISO-8859-1', true),ENT_COMPAT,'ISO-8859-1', true); // xss protection
            date_default_timezone_set("Asia/Kolkata");
            $CurrentTime=time();
            $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
            $DateTime;
            $PostID=mysqli_real_escape_string($connection, $_REQUEST["id"]);
            if(empty($Name)||empty($Email)||empty($Comment)){
                $_SESSION["ErrorMessage"]="all feilds are required.";
            }elseif(strlen($Comment)>500){
                $_SESSION["ErrorMessage"]="Comment should be no more than 500 characters";
            }else{
                global $connection;
                $PostIDFromURL=$_GET['id'];
                $Query="INSERT INTO comments (datetime,name,email,comment,status,admin_panel_id,approvedby)
                VALUES ('$DateTime','$Name','$Email','$Comment','OFF','$PostIDFromURL','pending')";
                $Execute=mysqli_query($connection,$Query);
                if($Execute){
                    $_SESSION["SuccessMessage"]="Comment submitted successfully";
                    Redirect_to("fullPost?id={$PostID}");
                }else{
                    $_SESSION["ErrorMessage"]="Something went wrong!";
                    Redirect_to("fullPost?id={$PostID}");
                }   
            }
        }
    }
}
?>
<!DOCTYPE>

<html>
    <head>
        <title>Full Article</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/publicstyles.css">
        <style>
            .FieldInfo{
                color: rgb(251,174,44);
                font-family: Bitter,Georgia,Times,"Times New Roman",serif;
                font-size: 1.2em;
            }
            .CommentBlock{
                background-color: #F6F7F9;
            }
            .Comment-Info{
                color: #365899;
                font-family: sans-serif;
                font-size: 1.1en;
                font-weight: bold;
                padding-top: 10px;
            }
            .Comment{
                margin-top: -2px;
                font-size: 1.1en;
                padding-bottom: 10px;
            }
            </style>
    </head>
    <body>
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
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li ><a href="portal">Portal</a></li>
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
            </li>
            <!-- <li><a href="#">Contact Us</a></li> -->
            <li><a href="#">Feature</a></li>
        </ul>
        <form action="portal" class="navbar-form navbar-right">
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
            <?php  echo Message();
                    echo SuccessMessage();
         ?>
            <?php
            global $connection;
            if(isset($_GET["SearchButton"])){
                $Search=mysqli_real_escape_string($connection, $_REQUEST["Search"]);
                $ViewQuery="SELECT * FROM admin_panel 
                WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
                OR category LIKE '%$Search%' or post LIKE '%$Search$'";    
            }
            else{
            $PostIDFromURL=mysqli_real_escape_string($connection, $_REQUEST["id"]);
            $ViewQuery="SELECT * FROM admin_panel  WHERE id='$PostIDFromURL'
            ORDER BY datetime desc";}
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
            
            echo nl2br($Post); ?> </p>  
            </div>

            </div>
            <?php } ?>
            <br><br>
            <br><br>
            <span class="FieldInfo">Comments</span>
            <?php
            global $connection;
            $PostIDForComments=mysqli_real_escape_string($connection, $_REQUEST["id"]);
            $ExtractingCommentsQuery="SELECT * FROM comments
            WHERE admin_panel_id='$PostIDForComments' AND status='ON'";
            $Execute=mysqli_query($connection,$ExtractingCommentsQuery);
            while($DataRows=mysqli_fetch_array($Execute)){
                $CommentDate=$DataRows["datetime"];
                $CommenterName=$DataRows["name"];
                $CommentbyUsers=$DataRows["comment"];
            
            ?>
            <div class="CommentBlock">
                <img style="margin-left: 10px; margin-top: 10px;"class="pull-left" src="images/comment.png" width=70px; height=70px;>
                <p style="margin-left: 90px;"class="Comment-Info"><?php echo $CommenterName; ?></p>
                <p style="margin-left: 90px;"class="description"><?php echo $CommentDate; ?></p>
                <p style="margin-left: 90px;"class="Comment"><?php echo nl2br($CommentbyUsers); ?></p>

            </div>

            <hr>
            <?php } ?>
            <br>
            <span class ="FieldInfo">Share your thoughts about this post</span>
            <div>
        <form action="fullPost?id=<?php echo $_REQUEST["id" ]; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
            <label for="Name"><span  class="FieldInfo">Name:</span></label>
            <input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
            </div>
            <div class="form-group">
            <label for="Email"><span  class="FieldInfo">Email:</span></label>
            <input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
            <input type="hidden" name="csrf_token" value="<?php echo generateToken('protectedComment'); ?>"/>
            </div>
            <div class="form-group">
            <label for="commentarea"><span class="FieldInfo">Comment</span></label>
            <textarea class="form-control" name="Comment" id="commentarea"></textarea>
            </div>
            <br>
            <input class="btn btn-primary btn-lg"type="Submit" name="Submit" value="Submit">
        </fieldset>
        <br>
        </form>
        </div>
            </div><!--Main area ending-->
            <div class="col-sm-offset-1 col-sm-3">
            <<h2>Maharashtra Cyber</h2>
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
                <a href="Portal.php?category=<?php echo $Category; ?>">
                <span id="heading"><?php echo $Category."<br>";?></span>
                </a>
                <div class="panel-footer"></div>
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