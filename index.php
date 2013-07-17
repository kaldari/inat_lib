<!DOCTYPE html>
<html>
<head>
  <title>iNaturalist | Home</title>
  <meta name="description" content="iNaturalist home">
  <meta name="author" content="Kyle Garsuta">
  <link rel="stylesheet" type="text/css" href="css/inat.css">
  
  <!-- jQuery-->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  
  <!-- jQuery Boxer plugin -->
  <script src="http://www.benplum.com/js/site.js"></script>
  <link href="http://www.benplum.com/lab/_Formstone/Boxer/jquery.fs.boxer.css" 
    rel="stylesheet" type="text/css" media="all" />
  <script src="http://www.benplum.com/lab/_Formstone/Boxer/jquery.fs.boxer.js"></script>
  
  <!-- jQuery Cookie plugin -->
  <script src="js/jquery/plugins/jquery-cookie-master/jquery.cookie.js"></script>
  
  <style>
    .boxer-content[style] {
      overflow-y: hidden !important;
    }
  </style>
</head>
<body>
  <div id="form">
    <fieldset id='current_user' >
      <?php include 'block/this_user/user.block.php' ?>
    </fieldset>
    
    <fieldset>
      <p>
        <input id="login" type="button" onclick="window.location = 'login.html'" value="Log in to iNaturalist">
      </p>      
      <p>
        <input id="add_obs" type="button" onclick="window.location = 'add_obs.html'" value="Add an observation">
      </p>
      <p>
        <input id="register" type="button" onclick="window.location = 'register.html'" value="Register">
      </p>
      <p>
        <input id="logout" type="button" onclick="logout()" value="Logout">
      </p>
    </fieldset>

    <fieldset>
      <p>
      <?php include 'block/all_obs/all_obs.block.php'; ?>
      </p>
    </fieldset>
    </div>

  <script type="text/javascript">
    function logout() {
    // PRE: User is logged in
    // POST: User is logged out
      $.removeCookie('inat_auth', { path: '/' });
      location.reload();
    }
  </script>
  <script>
    $(document).ready(function() {
      $(".boxer").boxer({
        fixed: false,
      });
    });
  </script>
  <script>
    // Displays/hides items as accordingly (e.g. hide login if already logged in)
    if(typeof $.cookie('inat_auth') != 'undefined') {
      document.getElementById("login").style.display="none";
      document.getElementById("register").style.display="none";
       
    } else {
      document.getElementById("add_obs").style.display="none";
      document.getElementById("logout").style.display="none";
      document.getElementById("edit_user").style.display="none";
    }
  </script>
</body>
</html>
