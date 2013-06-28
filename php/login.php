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
$query_string = "$inat_url/oauth/token";
$context = stream_context_create($opts);
$fp = fopen($query_string, 'r', false, $context);
if($fp) {
  // Parse server response
  $response = json_decode(stream_get_contents($fp));
  fclose($fp);

  // Set cookie based on parsed data
  $cookie_value = $response->{'token_type'} . ' ' . $response->{'access_token'};
  $expire_in = $response->{'expires_in'};
  $expire_default = time() + ($logged_in_days * 24 * 60 * 60);
  // Cookie expires as set by server or to default days set in config.php
  $expiry = $expire_in ? $expire_in : $expire_default;
  setcookie("inat_auth", $cookie_value, $expiry, '/');

  // Add user to project
  $authorization = ucfirst($cookie_value);
  $opts = array(
    'http'=>array(
      'method'=>"POST",
      'header'=>"Authorization: $authorization",
    )
  );
  $context = stream_context_create($opts);
  fopen("$inat_url/projects/$project/join", 'r', false, $context);
  // Failure to join project does not affect login
  
  // Redirect to set page
  header("Location: $url_after_login");
  die();

} else {
  // Redirect to referrer; prompt for valid login
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  die();
}

