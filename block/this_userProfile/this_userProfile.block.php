<!DOCTYPE html>
<html>
	<body>
	  <div id='block'>
    <?php
    if( isset($_COOKIE['inat_auth']) )
      include dirname(__FILE__) . '/../this_user/user.block.php';
    else {
      include dirname(__FILE__) . '/../login/login.block.php';
    }
    ?>
    </div>
	</body>
</html>
