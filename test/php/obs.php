<?php

/* File:            obs.php
 * Author:          Kyle Garsuta
 * Created:         8 Jul 2013
 *
 * Description:     
 */

// Include global config
// include_once "config.php";

function get_content($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

class obs {
/*
 * 
 */

  public $id;
  
  public function get($id) {
  // Fetches an observation with the given id from inaturalist.org
  // PRE: Valid obs id
  // POST: Obs data stored in class variables
  
  echo get_content("http://www.inaturalist.org/observations/$id.json");
  }
}

$obs = new obs();
$obs->get(298762);













