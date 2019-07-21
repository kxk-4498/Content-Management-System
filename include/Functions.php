<?php require_once("include/db.php");?>
<?php require_once("include/Sessions.php");?>
<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
}

function Login_Attempt($Username,$Password){
    global $connection;
    $Query="SELECT * FROM admin_registration 
    WHERE username='$Username' AND password='$Password'";
     $Execute=mysqli_query($connection,$Query);
     if($admin=mysqli_fetch_assoc($Execute)){
         return $admin;
    }else{
        return null;
    }
}

function Login(){
    if(isset($_SESSION["User_Id"])){
        return true;
    }
}

function Confirm_Login(){
    if(!Login()){
        $_SESSION["ErrorMessage"]="Login Required!";
        Redirect_to("login");
    }
}


function Confirm_Admin(){
    if(!($_SESSION["UserType"]==0)){
        $_SESSION["ErrorMessage"]="Admin Login Required!";
        Redirect_to("auther_dashboard");
    }
}


/**
 * generate CSRF token
 * 
 * @param   string $formName
 * @return  string  
 */
function generateToken( $formName ) 
{
    $secretKey = 'gsfhs154aergz2#';
    if ( !session_id() ) {
        session_start();
        }
        $sessionId = session_id();
        return sha1( $formName.$sessionId.$secretKey );
}

/**
 * check CSRF token
 * 
* @param   string $token
 * @param   string $formName
 * @return  boolean  
 */
function checkToken( $token, $formName ) 
{
    return $token === generateToken( $formName );
}

  
?>