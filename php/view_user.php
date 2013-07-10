<?php

/* File:            view_user.php
 * Author:          Kyle Garsuta
 * Created:         10 Jul 2013
 * 
 * Description      Displays a user with the input id
 */

include_once 'user.class.php';

// Get obs id from query string
$user_id = $_GET["user_id"];

$user = new user($user_id);
echo $user->html();

?>
