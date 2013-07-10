<?php

/* File:            project_observations_list.class.php
 * Author:          Kyle Garsuta
 * Created:         9 Jul 2013 
 */

include_once "config.php";
include_once "observation.class.php";

class project_observations_list {

  // List of obs ids
  public $obs_list = array();

  public function __construct($uid = NULL) {
  // Default constructor
  // POST:  WITH uid, get user obs
  //        WITOUT uid, get all proj obs
    $this->get_list($uid);
  }

  public function print_proj_obs() {
  // Print observations in a table
    
    // Print headers
    echo "<table>";   
    echo '<th>' . "Posted" . '</th>';
    echo '<th>' . "Date observed" . '</th>';
    echo '<th>' . "User" . '</th>';
    echo '<th>' . "Species" . '</th>'; 

    for($i=0; $i < count($this->obs_list); $i++) {

      echo '<tr>';
      echo '<td>' . $this->obs_list[$i]['created_at'] . '</td>';
      echo '<td>' . $this->obs_list[$i]['observed_on'] . '</td>';
      echo '<td>' . $this->obs_list[$i]['user_login'] . '</td>';
      echo '<td>' . $this->obs_list[$i]['species_guess'] . '</td>';
      echo '</tr>';
    }
    echo '</table>';
  }

  private function http_get($url){
  // A helper function that GETs the input url
  // POST: Returns server response
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
  
  private function get_list($uid = NULL){
  // A helper function that GETs the ids of observations in the project
  // PRE: Valid user id or blank id
  // POST:  WITHOUT uid, GET all project obs
  //        WITH uid, GET user obs

    global $project;
    
    if($uid == NULL) {
      $data = $this->http_get("http://www.inaturalist.org/observations/project/$project.json");
    } else {
      $data = $this->http_get("http://www.inaturalist.org/observations/$uid.json");
    }
    $data = json_decode($data, true);
    $this->obs_list = $data;
  }

}

