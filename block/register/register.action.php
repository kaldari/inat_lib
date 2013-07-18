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
 *  This file was initially used as proof of concept and needs
 *  re-implementation and cleaning up; nevertheless functional for now
 */

include_once "config.php";
include_once "inat.php";

include_once dirname(__FILE__) . '/../../config/settings.php';
global $lib_rootURL;

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
    echo "<center>You are now logged in. Please wait...</center>";
    echo "<script>window.parent.location.reload()</script>";
    die();
  }
} else {
  // Redirect to referrer; prompt for valid login
  echo "<center>Failed to register, please try again.</center>";
  die();
}
