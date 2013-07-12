<?php

include_once dirname(__FILE__) . '/../controller/species_controller.class.php';

$controller = new speciesController($_GET['id']);
$controller->display();

?>

