<?php

/* File:            user.class.php
 * Author:          Kyle Garsuta
 * Created:         10 Jul 2013
 * 
 * Description      This file defines the user class
 */

class userModel {

  public $data = NULL;

  public function __construct($id) {
  // Default constructor
  
    // WITH id, fetch from iNat
      $this->get_user($id);
  }
  
  public function data() {
  // Returns data
    return $this->data;
  }

  private function get_user($id) {
  // Constructor helper to construct a user
  // GETs a user with the input id from inaturalist.org
  // PRE: Valid user id
  // POST: User data stored in class variables
    $this->data = json_decode( 
      $this->http_get("http://www.inaturalist.org/people/$id.json"), true );
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

