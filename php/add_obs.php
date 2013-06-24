<?php

/* File:            add_obs.php
 * Author:          Kyle Garsuta
 * Created:         19 Jun 2013
 * Last modified:   21 Jun 2013 by Kyle
 * PRE:             Valid OAuth 2.0 token must be stored in 'inat_auth' cookie
 * POST:            User observation is posted to iNaturalist.org
 *
 * Description:     
 *  This program submits an authenticated HTTP POST request
 *  using the iNaturalist.org API on behalf of a user. The user must have completed the
 *  OAuth 2.0 authentication proccess and obtained a valid access token.
 *  
 *  See iNat API Reference: http://www.inaturalist.org/pages/api+reference
 *
 *  This program is in the early stages of development and serves as a rudimentary proof
 *  of concept.
 */

// Site variables
$base_url = "https://www.inaturalist.org";

// Construct authorization string from cookie
$authorization = "Bearer " . $_COOKIE['inat_auth'];

// Construct query string (i.e. from html post data)
$query_string = "$base_url/observations.json?";
foreach ($_POST as $key => $value) {
  if(($value != NULL) || ($value != "")){
    $query_string = $query_string . "observation[" 
      . urlencode($key) . "]=" . urlencode($value) . "&";
  }
}

// Configure options for http post
$opts = array(
  'http'=>array(
    'method'=>"POST",
    'header'=>"Authorization: $authorization"
  )
);

// Send http post request
$context = stream_context_create($opts);
$fp = fopen($query_string, 'r', false, $context);

// Print server response
$server_response = stream_get_contents($fp);

// TODO - iNat reply is in json format and has to be decoded
// Hide response for now and display confirmation message
// echo $server_response;
fclose($fp);
echo "<p><h1>Thank you for your submission!</h1></p>";

?>

