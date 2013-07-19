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
  
    /*
    foreach ($this->data as $key => $value) {
      echo "<b>$key</b> is $value</br>";
    }
    */
  
    // Construct all names list
    $all_names = "<ul>";
    foreach ($this->data["taxon_names"] as $key => $array) {
      $name = $lexicon = "";
      foreach ($array as $key => $value) {
        if($key=="lexicon")
          $lexicon = $value;
        if($key=="name")
          $name = $value;
      }
      $all_names .= "<li>$name ($lexicon)</li>";
    } $all_names .= "</ul>";

    return
    '<div class="page-container" id="view_species">
      
       <div class="container">
        <h2>' . $this->data["name"] . 
          ' (' . $this->data["common_name"]["name"] . ')</h2>
      </div>
		
		  <div class="container" id="species_profile">
        <div id="species_photos" class="column-left">
          <img src="' . $this->data["default_photo"]["large_url"] . 
            '" class="speciesPhoto_default" >
        </div>
        <div id="species_summary" class="column-right">
          <div id="species_names">
            <h3>All names</h3>' .
              $all_names .
          '</div>
        </div>
      </div>
      
      <div class="container" id="species_desc">
        <h3>Description from Wikipedia</h3>' .
        '<p>' . $this->data["wikipedia_summary"] . '</p>' .
		  '</div>
      
    </div>
    ';
  }
}

