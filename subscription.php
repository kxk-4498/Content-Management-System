<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<!DOCTYPE>

<html>
    <head>
        <title>Portal</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/publicstyles.css">
        <style>
            .blue {
    color: #2C9BB3 !important;
}
.column-title 
{
  margin-top: 5px;
  padding-bottom: 15px;
  border-bottom: 1px solid #eee;
  margin-bottom: 15px;
  position: relative;
  font-size:30px !important;
  
}
        </style>
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
        <div class="container-fluid">
  <div class="row row-centered">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered">
        <div class="row row-centered">
            <div class="col-xs-12 grid col-centered">
              <div class="border_gray grid_content content_grid">
                <h4 class="column-title in_center"><center><i class="fa fa-pencil blue"> </i> <span class="blue">Portal Subscription</span></center></h4>                 
	                <form role="form" method="POST" action="subscription.php">
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'>Name *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
								<div class="form-group">
									<input type="text" value="" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name *">
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<div class="form-group">
									<input type="text" value="" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
								</span>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'>Mobile No. *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<div class="form-group">
									<input type="text" value="" name="mobile" id="mobile" class="form-control input-lg" placeholder="Mobile No. - With Country Code *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
																	</span>
							</div>
						</div>


						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'>Email - Will be Used as Username</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<div class="form-group">
									<input type="email" value="" name="email" id="email" class="form-control input-lg" placeholder="Email *">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
																	</span>
							</div>
						</div>
						
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'>Password *</b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
								<div class="form-group">
									<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password *" >
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<div class="form-group">
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password *" tabindex="6">
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
																										</span>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'>User Type * </b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3">
								<div class="form-group">
									<select name="user_type" class="form-control">
<option value="" selected="selected">User Type</option>
</select>								</div>
							</div>
						</div>
						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
																	</span>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3"><b class='blue'>Address </b> </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3">
								<div class="form-group">
									<input type="text" value="" name="address" id="address" class="form-control input-lg" placeholder="Address">
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:0;padding-top:0;">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-sm-offset-3">
								<span class="red">
																	</span>
							</div>
						</div><br/>

						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3 text-center">
								<!-- By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use. -->
								<a href="#" data-toggle="modal" data-target="#t_and_c_m">By clicking register, you agree to the terms and conditions set out by this site</a>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
						</div>
					</form>
              </div>
            </div>
        </div>
    </div>

  </div> <!-- end column middle area -->
</div> <!-- end container main content -->




<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
				<h4 class="modal-title" id="myModalLabel">Terms and Conditions</h4>
			</div>
			<div class="modal-body">
				<ul>
 <li><strong>All copyright, trade marks, design rights,</strong> patents and other intellectual property rights (registered and unregistered) in and on CMS Online Services and CMS Content belong to the Maharashtra Cyber.</li>
 <li>The Maharashtra Cyber reserves all of its rights in CMS Content and CMS Online Services. Nothing in the Terms grants you a right or licence to use any trade mark, design right or copyright owned or controlled by the Maharashtra Cyber or any other third party except as expressly provided in the Terms.</li>
</ul>			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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