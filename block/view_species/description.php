<?php
$title = $_GET['title'];
echo '<iframe width="100%" height="700" id="species_desc" ' . 
  'src="http://en.wikipedia.org/wiki/' . $title . '?printable=yes"></iframe>';

?>
