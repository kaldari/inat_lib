<?php

include_once dirname(__FILE__) . '/../../mvc/controller/user_controller.class.php';

$controller = new userController($_GET['id']);
$controller->display();

?>

