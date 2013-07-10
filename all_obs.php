<!DOCTYPE html>
<html>
<head>
  <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/overlay/standalone.css"/>
  <link rel="stylesheet" type="text/css" href="css/overlay/overlay_basic.css"/>
  <link rel="stylesheet" type="text/css" href="css/overlay/all_obs.css"/>
  <script>
    // Calls the php code to display obs details
    function view_obs(obs_id) {
      $("#details").load('php/view_obs.php' + '/?obs_id=' + obs_id);
    }

    function view_user(user_id) {
      $("#details").load('php/view_user.php' + '/?user_id=' + user_id);
    }
  </script>
</head>

<body>
  <div>
    <p><center>
      <?php
      include_once 'php/project_observations_list.class.php';
      // Create new project obs object
      $obs_list = new project_observations_list();

      // Print project obs list table html
      echo $obs_list->html_table();
      ?>
    </p></center>
  </div>

  <!-- overlay -->
  <div class="simple_overlay" id="mies1" >
    <img id="photos" class="photos" src="http://farm8.staticflickr.com/7072/7161280137_35991cb2b7_b.jpg" />
    <div id="details" class="details"></div>
  </div>

  <script>
    // Trigers the overlay on user click
    $(document).ready(function() {
        $("a[rel]").overlay({
	        top: 25,
          absolute: false,
        });
      });
  </script>
</body>
</html>
