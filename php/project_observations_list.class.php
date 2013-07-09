<?php

/* File:            project_observations_list.class.php
 * Author:          Kyle Garsuta
 * Created:         9 Jul 2013
 *
 * Description:     
 */

include_once "config.php";
include_once "observation.class.php";

class project_observations_list {

  public $obs_id_list = array();

  public function __construct($uid = NULL) {
  // Default constructor
    if($uid == NULL) {
      $this->get_list("iseahorse");
    }
  }

  public function print_all($choices) {
  // Print all observations in a table
  // Param: $choices is an array containing the name of fields
  //  you would like to display

    echo '<table id="observations_list">';
    for($k=0; $k < count($choices); $k++) {
      echo '<th id=' . $choices[$k] . '>' . $choices[$k] . '</th>';
    }

    for($i=0; $i < count($this->obs_id_list); $i++) {
      $obs = new observation($this->obs_id_list[$i]);
      echo '<tr>';
      for($j=0; $j < count($choices); $j++) {
        echo '<td>' . $obs->data[$choices[$j]] . '</td>';
      }
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
  
  private function get_list($project){
  // A helper function that GETs the ids of all obs in the project
  // PRE: Valid project id
  // POST: Observation list json stored in $this->obs_id_list

    $data = $this->http_get("http://www.inaturalist.org/observations/project/$project.json");
    $data = json_decode($data, true);
    for($i=0; $i < count($data); $i++) {
      $this->obs_id_list[$i] = $data[$i]['id'];
    }
  }
}
