<?php

/* File:            login.php
 * Author:          Kyle Garsuta
 * Created:         27 Jun 2013
 *
 * Description:     
 *  This file is called to log in a user from the login form.
 *  This file was initially used as proof of concept and needs
 *  re-implementation and cleaning up; nevertheless functional for now
 */

include_once dirname(__FILE__) . '/../../config/settings.php';
global $lib_rootURL;

// Inaturalist secure url
$inat_url = "https://www.inaturalist.org";

// Register url
$register_url = "http://localhost/inaturalist/register.html";

// Register url
// Used in: register.php, login.php
$login_url = "http://localhost/inaturalist/login.html";

// App information
// Used in: login.php
$client_id = "7d8200b28bcbd03f76550993813c55bd2bb46d6700624565867e8ccb499c9e0c";
$client_secret = "49c6e64bc7c144560974635f52073cfcbe6e2a4a026267f4090303b86df77a7a";
$redirect_uri = "http://localhost/inaturalist/callback.html";

// KEEP
// Project name
// Used in: login.php
$project = "iseahorse";
$proj_id = 871;

// Set a default value for how long to stay logged in
// Used in: login.php
$logged_in_days = 7;

// This is the homepage of the host site, used to redirect after certain actions
$base_url = "http://localhost/inaturalist";

// The url you want to redirect after an observation is submitted
$url_after_add_obs = $base_url;

// Where to redirect after login?
// Used in: login.php
$url_after_login = $base_url;


function http_post($header,$content,$url) {
/*
 * A helper function to perform an http given a
 *  string containing the header and an array
 *  containing the content, to the given url.
 * Content-Type and Content-Length headers are
 *  automatically generated.
 *  
 *  PRE: Valid header string
 *    (e.g. "Authorization: token_here" . "\r\n"),
 *    valid content array, and
 *    valid url
 *  POST: http post request performed
 *    Returns a string of server response on success
 *    Returns false on error
 */

  $content = http_build_query($content);

  // Configure options for http post
  $opts = array(
    'http'=>array(
      'method'=>"POST",
      'header' => "Content-Type: application/x-www-form-urlencoded" . "\r\n" .
                  "Content-Length: ". strlen($content) . "\r\n" . 
                  $header,
      'content' => $content,
    )
  );

  // Send http post request
  $context = stream_context_create($opts);
  return stream_get_contents(fopen($url, 'r', false, $context));
}

function login($user,$pass) {
/*
 *  This program submits an HTTP POST request using the iNaturalist.org API
 *  on behalf of a user. The user is then logged in using the provided 
 *  username and password.
 *
 * PRE:   Valid username and password input
 * POST:  If VALID login:
 *          User is logged in
 *          Auth token saved to cookie 'inat_auth'
 *          User automatically added to project
 *          Returns TRUE
 *        If INVALID login:
 *          Returns FALSE
*/

  // Declare global variables from 'config.php'
  global $logged_in_days, $project;

  // Configure post body
  $content = array();
  $content["username"] = $user;
  $content["password"] = $pass;
  $content["client_id"] = $GLOBALS['client_id'];
  $content["client_secret"] = $GLOBALS['client_secret'];
  $content["redirect_uri"] = $GLOBALS['redirect_uri'];
  $content["grant_type"] = "password";
  $content["response_type"] = "token";
  $content["username"] = $user;

  $response = http_post("",$content,"https://www.inaturalist.org/oauth/token");

  if($response) {
    // Parse server response
    $response = json_decode($response);

    // Set cookie based on parsed data
    $cookie_value = $response->{'token_type'} . ' ' . $response->{'access_token'};
    // Capitalize cookie value because Oauth only accepts 'Bearer' not 'bearer'
    $cookie_value = ucfirst($cookie_value);
    $expire_in = $response->{'expires_in'};
    $expire_default = time() + ($logged_in_days * 24 * 60 * 60);
    // Cookie expires as set by server or to default days set in config.php
    $expiry = $expire_in ? $expire_in : $expire_default;
    setcookie('inat_auth', $cookie_value, $expiry, '/');

    // Add user to project
    $header = "Authorization: ". ucfirst($cookie_value) . "\r\n";
    http_post($header,$content,"https://www.inaturalist.org/projects/$project/join");
    // Failure to join project does not affect login

    return true;

  } else {
    return false;
  }
}

if( login($_POST['login'], $_POST['password']) ) {
  // Redirect to set page
  header("Location: $lib_rootURL");
} else {
  // Redirect to referrer; prompt for valid login
  $referrer = $_SERVER['HTTP_REFERER'];
  header("Refresh: 3; url=$referrer");
  echo "<center>Invalid username or password. Please try again...</center>";
}

