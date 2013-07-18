<html>
	<body>
	<!-- Include jQuery -->
  <?php include_once 'includes/jquery.include.php' ?>

	<!-- Include jQuery Validate -->
  <?php include_once 'includes/jquery-validate.include.php' ?>
  
  <?php
  // Display the user edit block
    include_once dirname(__FILE__) . 
      '/../../mvc/controller/this_user_controller.class.php';
    $controller = new thisUserController();
    $controller->display_editUser();
  ?>
	</body>
</html>
