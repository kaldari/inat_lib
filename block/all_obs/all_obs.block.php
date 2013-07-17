<!DOCTYPE html>
<html>
<head>
  <script>
    // Calls the php code to display obs details
    function view_obs(obs_id) {
      $("#details").load('../../mvc/action/show_observation.php/?id=' + obs_id);
    }

    function view_user(user_id) {
      $("#details").load('../../mvc/action/show_user.php/?id=' + user_id);
    }
    
    function view_species(species_id) {
      $("#details").load('../../mvc/action/show_species.php/?id=' + species_id);
    }
  </script>
</head>

<body>
  <div id = 'body'>
    <p><center>
      <?php
      include_once dirname(__FILE__) . '/../../mvc/controller/observation_list_controller.class.php';

      $controller = new observationListController('project', 'iseahorse');
      $controller->display();
      ?>
    </p></center>
</body>
</html>
