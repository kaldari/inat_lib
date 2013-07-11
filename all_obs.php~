<!DOCTYPE html>
<html>
<head>
  <script src="js/jquery/plugins/jquery-tools/jquery.tools.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/overlay/standalone.css"/>
  <link rel="stylesheet" type="text/css" href="css/overlay/overlay_basic.css"/>
  <link rel="stylesheet" type="text/css" href="css/overlay/all_obs.css"/>
  <script>
    // Calls the php code to display obs details
    function view_obs(obs_id) {
      $("#details").load('php/display/view_observation.php/?id=' + obs_id);
    }

    function view_user(user_id) {
      $("#details").load('php/display/view_user.php/?id=' + user_id);
    }
    
    function view_species(species_id) {
      $("#details").load('php/display/view_species.php/?id=' + species_id);
    }
  </script>
</head>

<body>
  <div id = 'body'>
    <p><center>
      <?php
      include_once dirname(__FILE__) . '/php/controller/observation_list_controller.class.php';

      $controller = new observationListController('project', 'iseahorse');
      $controller->display();
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
	        top: 15,
          fixed: false,
          mask: '#fff',
        });
      });
  </script>
  

</body>
</html>
