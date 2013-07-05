<?php

/* File:            inat.php
 * Author:          Kyle Garsuta
 * Created:         2 Jul 2013
 *
 * Description:     
 *  This file contains functions used globally. See individual
 *  functions for corresponding description.
 */

// Include global config
include_once "config.php";

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
  global $inat_url, $logged_in_days, $project;

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

  $response = http_post("",$content,"$inat_url/oauth/token");

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
    http_post($header,$content,"$inat_url/projects/$project/join");
    // Failure to join project does not affect login

    return true;

  } else {
    return false;
  }
}

function add_obs_to_proj($obs_id) {

  global $inat_url, $proj_id;
  
  $content = array();
  $content["project_observation[observation_id]"] = $obs_id;
  $content["project_observation[project_id]"] = $proj_id;
  $header = "Authorization: ". ucfirst($_COOKIE['inat_auth']) . "\r\n";
  return http_post($header,$content,"$inat_url/project_observations");
}


