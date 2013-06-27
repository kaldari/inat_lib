<?php

/* File:            login.php
 * Author:          Kyle Garsuta
 * Created:         27 Jun 2013
 *
 * PRE:             Valid username and password input
 * POST:            User is logged in
 *                  Auth token saved to cookie 'inat_auth'
 *                  User automatically added to project
 *
 * Description:     
 *  This program submits an HTTP POST request using the iNaturalist.org API on behalf of a user. The user is then logged in
 *  using the provided username and password.
 *  
 *  See iNat API Reference: http://www.inaturalist.org/pages/api+reference
 *
 */

// config.php contains site info (e.g. client_id, client_secret, etc.)
include_once "config.php";

// Configure post body
$post = http_build_query(array(
    "username" => $_POST['login'],
    "password" => $_POST['password'],
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "redirect_uri" => $redirect_uri,
    "grant_type" => 'password',
    'response_type' => 'token',
));

// Configure options for http post
$opts = array(
  'http'=>array(
    'method'=>"POST",
    'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                "Content-Length: ". strlen($post) . "\r\n",  
    'content' => $post,
  )
);

// Send http post request
$query_string = "$base_url/oauth/token";
$context = stream_context_create($opts);
$fp = fopen($query_string, 'r', false, $context);
if($fp) {
  echo "<p><center><h1>Submission success!</center></h1></p>";
  
  // Print server response
  $server_response = stream_get_contents($fp);
  fclose($fp);
  echo $server_response;

  // TODO - iNat reply is in json format and has to be decoded
  // Hide response for now and display confirmation message
} else {
  echo "<p><center><h1>Submission error!</center></h1></p>";
}

