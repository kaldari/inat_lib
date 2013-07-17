<?php

include_once dirname(__FILE__) . '/../../mvc/controller/species_controller.class.php';

$controller = new speciesController($_GET['id']);
$controller->display();

?>

