
<!DOCTYPE html>
<html>
<head>
  <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/overlay/standalone.css"/>
  <link rel="stylesheet" type="text/css" href="css/overlay/overlay-basic.css"/>

  <style>
    /* some styling for triggers */
    #triggers {
    text-align:center;
    }

    #triggers img {
    cursor:pointer;
    margin:0 5px;
    background-color:#fff;
    border:1px solid #ccc;
    padding:2px;

    -moz-border-radius:4px;
    -webkit-border-radius:4px;

    }

    /* styling for elements inside overlay */
    .details {
    position:absolute;
    top:15px;
    right:15px;
    font-size:11px;
    color:#fff;
    width:150px;
    }

    .details h3 {
    color:#aba;
    font-size:15px;
    }
  </style>
  <script>
    function overlay(obs_id) {
      $("#details").html("<strong>" + obs_id + "</strong>");
    }
  </script>

</head>

<body>
  <div id="triggers">
    <p><center>
      <?php
      include_once 'php/project_observations_list.class.php';
      $obs_list = new project_observations_list();
      $obs_list->print_proj_obs();
      ?>
    </p></center>
  </div>

  <!-- overlay -->
  <div class="simple_overlay" id="mies1">
    <img src="http://farm4.static.flickr.com/3651/3445879840_7ca4b491e9.jpg" />
    <div id="details" class="details">

    </div>
  </div>

  <script>
    $(document).ready(function() {
        $("a[rel]").overlay();
      });
  </script>
</body>
</html>
