<?php

/* File:            obs.php
 * Author:          Kyle Garsuta
 * Created:         8 Jul 2013
 *
 * Description:     
 */

// Include global config
// include_once "config.php";

class obs {
/*
 * 
 */

  public $id;
  
  public function get($id) {
  // Fetches an observation with the given id from inaturalist.org
  // PRE: Valid obs id
  // POST: Obs data stored in class variables
  
  $this->id = $id;
  echo $this->id;
  }
}

$obs = new obs();
$obs->get(50);













