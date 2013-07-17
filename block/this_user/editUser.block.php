<html>
  <head>
  <script src="//cdnjs.cloudflare.com/ajax/libs/spin.js/1.2.7/spin.min.js"></script>
  </head>
	<body>
	  <div id='block'>
    <?php
      // Display the user view block
      include_once dirname(__FILE__) . 
        '/../../mvc/controller/this_user_controller.class.php';
      $controller = new thisUserController();
      $controller->display_editUser();
    ?>
    </div>
	</body>
</html>
