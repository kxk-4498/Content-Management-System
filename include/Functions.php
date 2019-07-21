<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
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