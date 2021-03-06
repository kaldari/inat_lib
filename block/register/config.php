<?php

/* File:            config.php
 * Author:          Kyle Garsuta
 * Created:         27 Jun 2013
 *
 * Description:     
 *  Contains important variables shared throughout the whole library.
 */

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
