<?php

/* File:            editUser.action.php
 * Author:          Kyle Garsuta
 * Created:         17 Jul 2013
 *
 * Updates user information based on form data
 */

include_once dirname(__FILE__) . '/../../mvc/controller/this_user_controller.class.php';

$data = array();
if($_POST['email']) $data['email'] = $_POST["email"];
if($_POST['password']) $data['password'] = $_POST["password"];
$controller = new thisUserController();
if( $controller->edit_user($data) ) {
  echo 'Please wait...';
  echo '<script>window.parent.location.reload(false);</script>';
}
