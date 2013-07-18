<!DOCTYPE html>
<html>
<head>
  <title>iNaturalist | Home</title>
  <meta name="description" content="iNaturalist home">
  <meta name="author" content="Kyle Garsuta">
  <link rel="stylesheet" type="text/css" href="css/inat.css">
</head>
<body>
  <!-- Include jQuery -->
  <?php include_once 'includes/jquery.include.php'; ?>
  
    <!-- Include jQuery Boxer plugin -->
  <?php include_once 'includes/jquery-boxer.include.php'; ?>
  
  <!-- Include jQuery Cookie plugin -->
  <?php include_once 'includes/jquery-cookie.include.php'; ?>
  
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
