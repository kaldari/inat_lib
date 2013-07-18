<html>
  <head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#form").validate();
      });
    </script>
  </head>
	<body>
    <?php
      // Display the user edit block
      include_once dirname(__FILE__) . 
        '/../../mvc/controller/this_user_controller.class.php';
      $controller = new thisUserController();
      $controller->display_editUser();
    ?>
	</body>
</html>
