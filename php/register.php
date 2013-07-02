<?php

/* File:            register.php
 * Author:          Kyle Garsuta
 * Created:         25 Jun 2013
 *
 * POST:            User is registered with iNaturalist.org
 *
 * Description:     
 *  This program submits registers a user account based on the information
 *  provided by the user.
 */

include_once "config.php";
include_once "inat.php";

// Construct query string (i.e. from html post data)
$query_string = "$inat_url/users.json?";
foreach ($_POST as $key => $value) {
  if(($value != NULL) || ($value != "")){
    $query_string = $query_string . "user[" 
      . urlencode($key) . "]=" . urlencode($value) . "&";
  }
}

// Configure options for http post
$opts = array(
  'http'=>array(
    'method'=>"POST"
  )
);

// Send http post request
$context = stream_context_create($opts);
$fp = fopen($query_string, 'r', false, $context);

if($fp) {
  // Print server response
  // $server_response = stream_get_contents($fp);
  // echo $server_response;

  fclose($fp);

  // Automatically log user in after successful registration
  if ( login($_POST['login'],$_POST['password']) ) {
    header("Refresh: 3; url=$login_url");
    echo "<center>You are now logged in. Redirecting in 3 seconds...</center>";
    die();
  }
} else {
  // Redirect to referrer; prompt for valid login
  header("Refresh: 3; url=$register_url");
  echo "<center>Failed to register, please try again. Redirecting in 3 seconds...</center>";
  die();
}
