<?php

include_once dirname(__FILE__) . '/../../mvc/controller/observation_controller.class.php';

$controller = new observationController($_GET['id']);
$controller->display();

?>

