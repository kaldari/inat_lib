<?php

/* File:            observation_list_view.class.php
 * Author:          Kyle Garsuta
 * Created:         11 Jul 2013
 * 
 * Description      Displays the project observations list
 */

include_once '../model/observation_list_model.class.php';

// Create new project obs object
$obs_list = new observation_list('project', 'iseahorse');

// Print project obs list table html
echo $obs_list->html_table();
      
?>
