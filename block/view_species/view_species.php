<?php

include_once dirname(__FILE__) . '/../../config/settings.php';
global $lib_rootURL;
  
echo '<link rel="stylesheet" type="text/css" ' .
 'href="' . $lib_rootURL . 'css/species_view.css">';
echo '<link rel="stylesheet" type="text/css" ' .
 'href="' . $lib_rootURL . 'css/global.css">';
   
include_once dirname(__FILE__) . '/../../mvc/controller/species_controller.class.php';

$controller = new speciesController($_GET['id']);
$controller->display();

?>

