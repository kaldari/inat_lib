<?php

/* File:            login.php
 * Author:          Kyle Garsuta
 * Created:         27 Jun 2013
 *
 * Description:     
 *  This file is called to log in a user from the login form.
 */

// config.php contains site info (e.g. client_id, client_secret, etc.)
include_once "config.php";
include_once "inat.php";

if( login($_POST['login'], $_POST['password']) ) {
  // Redirect to set page
  header("Location: $url_after_login");
} else {
  // Redirect to referrer; prompt for valid login
  header("Refresh: 3; url=$login_url");
  echo "<center>Invalid username or password. Please try again...</center>";
}

