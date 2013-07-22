<?php
include_once dirname(__FILE__) . '/../../config/settings.php';
include_once dirname(__FILE__) . '/../../mvc/controller/observation_controller.class.php';

global $lib_rootURL;

echo 
  '<!DOCTYPE html>
  <html>
    <head>
      <link rel="stylesheet" type="text/css"
        href="' . $lib_rootURL . 'css/view_observation/view_observation.css">
      <link rel="stylesheet" type="text/css"
        href="' . $lib_rootURL . 'css/global.css">
      <script type="text/javascript" 
        src="http://maps.google.com/maps/api/js?sensor=false"></script>
    </head>
  <body>' . "\n";
    
$controller = new observationController($_GET['id']);
$controller->display();

echo 
  "\n" .
  '</body>
  </html>';
?>
