<?php

/* File:            species_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the species view
 */

class speciesView {
  
  private $data = array();
  
  public function __construct($data) {
  // Default constructor
  // Param: $data is an array containing species data from inaturalist. See
  //        model for details.
  
    $this->data = $data;
  }
  
  public function html() {
  // Returns data in html format
  
    $html = '';
    foreach ($this->data as $key => $value) {
      $html = $html . "<b>$key</b> is $value</br>";
    }
    return $html;
  }
}

