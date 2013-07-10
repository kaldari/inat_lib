<?php

/* File:            view_obs.php
 * Author:          Kyle Garsuta
 * Created:         10 Jul 2013
 * 
 * Description      Displays the observation with the input id
 */

include_once 'observation.class.php';

// Get obs id from query string
$obs_id = $_GET["obs_id"];

$obs = new observation($obs_id);
echo $obs->html();

?>
