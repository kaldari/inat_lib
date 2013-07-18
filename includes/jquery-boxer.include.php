<?php

echo '
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
';

?>
