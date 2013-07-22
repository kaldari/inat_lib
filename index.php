<!DOCTYPE html>
<html>
<head>
  <title>iNaturalist | Home</title>
  <meta name="description" content="iNaturalist home">
  <meta name="author" content="Kyle Garsuta">
  <link rel="stylesheet" type="text/css" href="css/inat.css">
</head>
<body>
  <!-- jQuery-->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  
  <!-- jQuery Boxer plugin -->
  <script src="http://www.benplum.com/js/site.js"></script>
  <link href="http://www.benplum.com/lab/_Formstone/Boxer/jquery.fs.boxer.css" 
    rel="stylesheet" type="text/css" media="all" />
  <script src="http://www.benplum.com/lab/_Formstone/Boxer/jquery.fs.boxer.js"></script>
  <script>
    $(document).ready(function() {
      $(".boxer").boxer({
        fixed: false,
      });
    });
  </script>
  <style>
    .boxer-content[style] {
      overflow-y: hidden !important;
    }
  </style>
  
  <!-- jQuery Cookie plugin -->
  <script src="' . $lib_rootURL . 'js/jquery/plugins/jquery-cookie-master/jquery.cookie.js"></script>
  
  <div id="form">
    <fieldset id='current_user' >
      <?php include 'block/this_userProfile/this_userProfile.block.php'; ?>
    </fieldset>

    <fieldset>
      <p>
        <input id="add_obs" type="button" 
          onclick="window.location = 'add_obs.html'" value="Add an observation">
      </p>
      <?php include 'block/all_obs/all_obs.block.php'; ?>
    </fieldset>
    </div>
</body>
</html>
