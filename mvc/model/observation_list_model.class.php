<?php

/* File:            observation_list.class.php
 * Author:          Kyle Garsuta
 * Created:         9 Jul 2013 
 */

include_once dirname(__FILE__) . '/observation_model.class.php';

class observationListModel {

  // List of obs ids
  public $data = array();

  public function __construct($type, $id) {
  // Default constructor
  // POST:  WITH uid, get user obs
  //        WITOUT uid, get all proj obs
    
    if($type == 'project') {
      $data = $this->http_get("http://www.inaturalist.org/observations/project/$id.json");
    } else if ($type == 'user') {
      $data = $this->http_get("http://www.inaturalist.org/observations/$id.json");
    } else if ($type == 'species') {
      $data = $this->http_get("http://www.inaturalist.org/observations.json?taxon_id=" . $id);
    }
    $data = json_decode($data, true);
    $this->data = $data;
  }
  
  public function data() {
  // Returns data
    return $this->data;
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

}

