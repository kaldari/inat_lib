<?php

/* File:            logout.php
 * Author:          Kyle Garsuta
 * Created:         27 Jun 2013
 *
 * PRE:             User is logged in
 * POST:            User is logged out
 *                  'inat_auth' cookir removed
 *
 * Description:     A program that logs the user out.
 */

// config.php contains site info (e.g. client_id, client_secret, etc.)
include_once "config.php";

// Unset cookie
setcookie('inat_auth', '', 0);

// Redirect
header('Location: ' . $_SERVER['HTTP_REFERER']);
die();


