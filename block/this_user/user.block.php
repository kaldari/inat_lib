<!DOCTYPE html>
<html>
	<body>
	  <div id='block'>
    <?php
    // Display the user view block
    include_once dirname(__FILE__) . '/../../mvc/controller/this_user_controller.class.php';
    $controller = new thisUserController();
    $controller->display_block();
    ?>
    </div>
	</body>
</html>
