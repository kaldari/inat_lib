<?php

/* File:            observation_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the species controller
 */

class observationView {
  
  private $data = array();
  
  public function __construct($data) {
    $this->data = $data;
  }
  
  public function html() {
  // Displays data in html format
  
    $html = '';
    foreach ($this->data as $key => $value) {
      $html = $html . "<b>$key</b> is $value</br>";
    }
    return $html;
  }
}

