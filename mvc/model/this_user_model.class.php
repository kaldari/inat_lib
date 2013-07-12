<?php

/* File:            this_user.class.php
 * Author:          Kyle Garsuta
 * Created:         10 Jul 2013
 * 
 * Description      This file defines the this_user class
 */

class thisUserModel {

  private $data;
  private $data_update;

  public function __construct() {
  // Default constructor
  
      $this->get_user();
  }
  
  public function edit_user($data) {
  // PUTs updated user data to inaturalist.org
  // Param: Takes an array $data containing update info as described below
  // PRE: User is logged in
  // POST: Updated user data stored in class variable
    
    if($data['email']) $this->data_update["user[email]"] 
      = $data['email'];
    if($data['password']) $this->data_update["user[password]"] 
      = $data['password'];
    if($data['description']) $data_update->data_update["user[description]"] 
      = $data['description'];
    if($data['time_zone']) $data_update->data["user[time_zone]"] 
      = $data['time_zone'];
    
    $this->data = json_decode( $this->http_put_user(
      "http://www.inaturalist.org/users/" . $this->data['id'] . ".json"), true );
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
    $this->data = json_decode( $this->http_get_user(
      "http://www.inaturalist.org/users/edit.json"), true );
  }

  private function http_get_user($url){
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
  
  private function http_put_user($url){
  // A helper function that PUTs to the input url
  // This functiion assumes that update data is in $this->data_update
  // PRE: User is logged in
  // POST: Returns server response
    
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_HTTPHEADER,
      array('Authorization: ' . ucfirst($_COOKIE['inat_auth'])));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($this->data_update));
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
}

