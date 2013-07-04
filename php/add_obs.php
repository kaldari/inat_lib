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
$authorization = ucfirst($_COOKIE['inat_auth']);

// Construct query string (i.e. from html post data)
$query_string = $GLOBALS['inat_url'] . "/observations.json?";
$post_content = array();

foreach ($_POST as $key => $value) {
  if( ($value != NULL) || ($value != "") ){
    $field_type = substr( $key, strlen($key)-6, strlen($key) );

    if( $field_type == 'stndrd' ) {
      $key_ = substr($key, 0, -7);
      $post_content["observation[$key_]"] = $value;

    } else {
      $post_content["observation[observation_field_values_attributes[$key][observation_field_id]]"] = $key;
      $post_content["observation[observation_field_values_attributes[$key][value]]"] = $value;
      // Code for custom fields here
      //echo "key is $key, value is $value" . "_";
    }
  }
}

$post = http_build_query($post_content);

// Configure options for http post
$opts = array(
  'http'=>array(
    'method' => "POST",
    'header' => "Content-Type: application/x-www-form-urlencoded" . "\r\n" .
                "Content-Length: ". strlen($post) . "\r\n" .
                "Authorization: $authorization" . "\r\n",
    'content' => $post,
  )
);

// Send http post request
$context = stream_context_create($opts);
$fp = fopen($query_string, 'r', false, $context);
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

