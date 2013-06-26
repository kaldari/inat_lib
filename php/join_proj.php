<?php

/* File:            add_obs.php
 * Author:          Kyle Garsuta
 * Created:         26 Jun 2013
 *
 * PRE:             Valid OAuth 2.0 token must be stored in 'inat_auth' cookie
 * POST:            User observation is posted to iNaturalist.org
 *
 * Description:     
 *  This program submits an authenticated HTTP POST request
 *  on behalf of an authenticated user to join a project
 *  
 *  See iNat API Reference: http://www.inaturalist.org/pages/api+reference
 *
 */

// Site variables
$base_url = "https://www.inaturalist.org";

// Construct authorization string from cookie
$authorization = "Bearer " . $_COOKIE['inat_auth'];

// Configure options for http post
$opts = array(
  'http'=>array(
    'method'=>"POST",
    'header'=>"Authorization: $authorization"
  )
);

$context = stream_context_create($opts);

// Post request - user joins project
$project = "iseahorse";
if(fopen("$base_url/projects/$project/join", 'r', false, $context)) {
  echo "<p><center><h1>Successfully joined $project</center></h1></p>";
} else {
  echo "<p><center><h1>Failed to join $project</center></h1></p>";
}

