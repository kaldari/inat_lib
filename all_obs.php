<!DOCTYPE html>
<html>
<head>
  <title>iNaturalist | Home</title>
  <meta name="description" content="iNaturalist home">
  <meta name="author" content="Kyle Garsuta">
  <link rel="stylesheet" type="text/css" href="css/inat.css">

  <script src="js/jquery/jquery-1.10.1.min.js"></script>
  <script src="js/jquery/plugins/jquery-cookie-master/jquery.cookie.js"></script>
</head>
<body>
  <fieldset>
  <center>
  <?php
    include_once 'php/project_observations_list.class.php';

    $obs_list = new project_observations_list("juancruzado");
    $obs_list->print_proj_obs();
  ?>
  </center>
  </fieldset>
</body>
</html>
