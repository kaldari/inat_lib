<?php

include_once dirname(__FILE__) . '/../../config/settings.php';
include_once dirname(__FILE__) . 
  '/../../mvc/controller/species_controller.class.php';

global $lib_rootURL;

echo 
  '<!DOCTYPE html>
  <html>
    <head>
      <script 
        src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js">
        </script>
      <link rel="stylesheet" type="text/css"
        href="' . $lib_rootURL . 'css/view_species/view_species.css">
      <link rel="stylesheet" type="text/css"
        href="' . $lib_rootURL . 'css/global.css">
      <link rel="stylesheet" type="text/css"
        href="' . $lib_rootURL . 'css/view_species/standalone.css"/>
      <link rel="stylesheet" type="text/css"
        href="' . $lib_rootURL . 'css/view_species/tabs-no-images.css"/>
    </head>';
   
$controller = new speciesController($_GET["id"]);

$controller->display();

echo '</html>';
?>
