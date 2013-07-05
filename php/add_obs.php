<?php

/* File:            add_obs.php
 * Author:          Kyle Garsuta
 * Created:         19 Jun 2013
 *
 * PRE:             Valid OAuth 2.0 token must be stored in 'inat_auth' cookie
 * POST:            User observation is posted to iNaturalist.org
 *
 * Description:     
 *  This program submits an authenticated HTTP POST request
 *  using the iNaturalist.org API on behalf of a user. The user must have completed the
 *  OAuth 2.0 authentication proccess and obtained a valid access token.
 */

// Include global config
include_once "config.php";

// Include file(s) containing function(s) used
include_once "inat.php";

// Construct authorization string from cookie
// Capitalize 'Bearer' as iNat server won't accept 'bearer'
$authorization = "Authorization: ". ucfirst($_COOKIE['inat_auth'] . "\r\n");

// Construct query string (i.e. from html post data)
$url = $GLOBALS['inat_url'] . "/observations.json?";
$content = array();

foreach ($_POST as $key => $value) {
  if( ($value != NULL) || ($value != "") ){
    $field_type = substr( $key, strlen($key)-6, strlen($key) );

    if( $field_type == 'stndrd' ) {
      $key_ = substr($key, 0, -7);
      $content["observation[$key_]"] = $value;

    } else {
      $content["observation[observation_field_values_attributes[$key][observation_field_id]]"] = $key;
      $content["observation[observation_field_values_attributes[$key][value]]"] = $value;
    }
  }
}

$header = $authorization . "\r\n";
$fp = http_post($header,$content,$url);

if($fp) {
  echo "<p><center><h1>Submission success!</center></h1></p>";
  
  // Parse server response
  $response = stream_get_contents($fp);
  // Strip enclosing ] and [
  $response = substr($response, 1, -1);
  $response = json_decode($response);  
  
  // Extract observation id
  $obs_id = $response->{'id'};

} else {
  echo "<p><center><h1>Submission error!</center></h1></p>";
}

