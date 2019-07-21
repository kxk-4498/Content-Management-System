<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<!DOCTYPE>

<html>
    <head>
        <title>Portal</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
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
            <li><a href="#">About Us</a></li>
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
            <h1>Threat Intelligence</h1>
            </div>
        <div class="row">
            <div class="col-sm-12">
                <p>To address the growing problem of Threat Intelligence, Maharashtra Cyber, the nodal agency for Cyber Security under the Home Department, Govt. of Maharashtra has envisaged an Anti-Phishing Unit, a specialised team that will enact all measures required to help detect and act on such cases as-soon-as possible through focused coordination.</p>
         
            </div><!--Main area ending-->
        </div><!--Row Ending-->
        <div class="blog header">
            <h1>Maharashtra Cyber</h1>
        </div>
        <div class="row">
            <div class="col-sm-12">
            <p>Maharashtra Cyber ​is a nodal agency established by the Government of Maharashtra to tackle cyber crimes and other digital threats. It is engaged in building Cyber Infrastructure for Maharashtra, including Cyber Police Stations, anti-piracy systems, predictive policing systems, awareness about cyber crimesand initiatives, etc.</p>
            <p>Maharashtra Cyber is currently working on the development of an integrated technological environment for Maharashtra through the ​Maharashtra Cyber Security Project​. The department through its efforts made Maharashtra the first state in the country to have 47 cyber-police stations and 51 Cyber Labs to expedite the criminal investigation cycle. This project has 4 major components,
            <ul>
            <li>Technology Assisted Investigation (TAI),</li>
            <li>Technology Assisted Policing and Analytics Centre (TAPAC),</li>
            <li>Computer Emergency Response Team (CERT-MH),</li>
            <li>Centre of Excellence (CoE) for Cyber Security</li>
            </ul>
            </p>
            <p>
            Maharashtra Cyber is also involved in developing ​<b>Automated Multimodal Biometric Identification system ​(AMBIS)</b>, which is a state-of-the-art system envisaging Iris, Facial, Fingerprints and Palm prints for identification of the criminals.
            </p>
            <p>Maharashtra Cyber has established a multi-stakeholder anti-piracy unit to fight against online piracy in cyberspace. ​<b>Maharashtra Cyber Digital Crime Unit(MCDCU)</b> has been successful in taking down many piracy websites in its efforts and thus also strengthening the IPR regime in the country.</p>
            </div>
        </div>
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