<?php

/* File:            this_user.class.php
 * Author:          Kyle Garsuta
 * Created:         10 Jul 2013
 * 
 * Description      This file defines the this_user class
 */

class thisUserModel {

  private $data;

  public function __construct($id) {
  // Default constructor
  
      $this->get_user();
  }
  
  public function data() {
  // Returns data
    return $this->data;
  }

  private function get_user() {
  // Constructor helper to construct a user
  // GETs this logged in user from inaturalist.org
  // PRE: User is logged in
  // POST: User data stored in class variable
    $this->data = json_decode( 
      $this->http_get("http://www.inaturalist.org/users/edit.json"), true );
  }

  private function http_get($url){
  // A helper function that GETs the input url
  // PRE: User is logged in
  // POST: Returns server response
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_HTTPHEADER,
      array('Authorization: ' . ucfirst($_COOKIE['inat_auth'])));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
}

