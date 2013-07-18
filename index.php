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
      <?php include 'block/this_userProfile/this_userProfile.block.php' ?>
    </fieldset>

    <fieldset>
      <p>
        <input id="add_obs" type="button" onclick="window.location = 'add_obs.html'" value="Add an observation">
      </p>
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
</body>
</html>
