<?php
$id = $_GET["id"];
$range_kmz = "http://www.inaturalist.org/taxa/$id/range.kml";
echo '
  <iframe width="100%" height="450" frameborder="0" 
  scrolling="no" marginheight="0" marginwidth="0"
  src="https://maps.google.com/maps?q='. $range_kmz . '&amp;output=embed">
  </iframe>
';
?>
