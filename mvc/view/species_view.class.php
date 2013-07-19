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
      $name = $array["name"];
      $lexicon = $array["lexicon"];
      $all_names .= "<li>$name ($lexicon)</li>";
    } $all_names .= "</ul>";
    
    $common_name = $this->data["common_name"]["name"];
    $id = $this->data["id"];
    $range_kmz = urlencode("http://www.inaturalist.org/taxa/$id/range.kml");
    
    return
    '<div class="page-container" id="view_species">
      
       <div class="container">
        <h2>' . $this->data["name"] . 
          ($common_name ? (' ('.$common_name.')') : '') . '</h2>
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
      
      <div class="container">
        <script src="
          http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
        <link rel="stylesheet" type="text/css"
          href="http://jquerytools.org/media/css/standalone.css"/>

        <link rel="stylesheet" type="text/css"
            href="http://jquerytools.org/media/css/tabs-no-images.css"/>
        <ul class="css-tabs">
          <li><a id="t1" href="#tab1">Description</a></li>
          <li><a id="t2" href="#tab2">Range map</a></li>
          <li><a id="t3" href="#tab3">Tab 3</a></li>
        </ul>

        <div class="css-panes">
          <div id="species_desc">' .
            '<h3>Description from Wikipedia</h3>' .
            '<p>' . $this->data["wikipedia_summary"] . '</p>' . 
          '</div>

          <div>
            <div id="range_map">
              <iframe width="875" height="350" frameborder="0" 
              scrolling="no" marginheight="0" marginwidth="0"
              src="https://maps.google.com/maps?q='. $range_kmz . '&amp;output=embed">
              </iframe>
		        </div>
          </div>

          <div>
            Tab 3
          </div>
        </div>

        <script>
          $(function() {
          $(".css-tabs:first").tabs(".css-panes:first > div");
          });
        </script>
      </div>
      
      
      
      
      
 
      
    </div>
    ';
  }
}

