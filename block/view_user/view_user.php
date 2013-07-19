
  <?php
  include_once dirname(__FILE__) . '/../../config/settings.php';
  global $lib_rootURL;
  
  echo '<link rel="stylesheet" type="text/css" ' .
   'href="' . $lib_rootURL . 'css/user_view.css">';
  echo '<link rel="stylesheet" type="text/css" ' .
   'href="' . $lib_rootURL . 'css/global.css">';
   
  include_once dirname(__FILE__) . '/../../mvc/controller/user_controller.class.php';
  $controller = new userController($_GET['id']);
  $controller->display();
  ?>

