<?php

/* File:            add_obs.php
 * Author:          Kyle Garsuta
 * Created:         25 Jun 2013
 * Last modified:   25 Jun 2013 by Kyle
 * POST:            User is registered with iNaturalist.org
 *
 * Description:     
 *  This program submits registers a user account based on the information
 *  provided by the user.
 *  
 *  See iNat API Reference: http://www.inaturalist.org/pages/api+reference
 *
 *  This program is in the early stages of development and serves as a rudimentary proof
 *  of concept.
 */

// Site variables
$base_url = "https://www.inaturalist.org";

// Construct query string (i.e. from html post data)
$query_string = "$base_url/users.json?";
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

// Print server response
$server_response = stream_get_contents($fp);

// TODO - iNat reply is in json format and has to be decoded
// Hide response for now and display confirmation message
echo $server_response;
fclose($fp);
echo "<p><h1>Thank you for your submission!</h1></p>";

?>

