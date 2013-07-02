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

function login($user,$pass) {
/*
 * PRE:   Valid username and password input
 * POST:  If VALID login:
 *          User is logged in
 *          Auth token saved to cookie 'inat_auth'
 *          User automatically added to project
 *          Returns TRUE
 *        If INVALID login:
 *          Returns FALSE
 *
 *  This program submits an HTTP POST request using the iNaturalist.org API
 *  on behalf of a user. The user is then logged in using the provided 
 *  username and password.
*/

  // Declare global variables from 'config.php'
  global $inat_url, $logged_in_days, $project;

  // Configure post body
  $post = http_build_query(array(
      "username" => $user,
      "password" => $pass,
      "client_id" => $GLOBALS['client_id'],
      "client_secret" => $GLOBALS['client_secret'],
      "redirect_uri" => $GLOBALS['redirect_uri'],
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
    // Capitalize cookie value because Oauth only accepts 'Bearer' not 'bearer'
    $cookie_value = ucfirst($cookie_value);
    $expire_in = $response->{'expires_in'};
    $expire_default = time() + ($logged_in_days * 24 * 60 * 60);
    // Cookie expires as set by server or to default days set in config.php
    $expiry = $expire_in ? $expire_in : $expire_default;
    setcookie('inat_auth', $cookie_value, $expiry, '/');

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

    return true;

  } else {
    return false;
  }
}

function add_obs_to_proj($obs_id,$proj_id) {
  return true;
}
