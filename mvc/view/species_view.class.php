<?php

/* File:            species_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the species view
 */

include_once dirname(__FILE__) . '/../../config/settings.php';

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
    
    global $lib_rootURL;
    
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
    '<body>
    <div class="page-container" id="view_species">  

		  <div class="container" id="species_profile">
        <h2>' . $this->data["name"] . 
          ($common_name ? (' ('.$common_name.')') : '') . 
        '</h2>
        
        <style>
          #species_photos {
            background-image: url("' . $this->data["default_photo"]["large_url"] . '");
            background-repeat: no-repeat;
            background-size: contain;
          }
        </style>
        <div id="species_photos" class="column-left" >
        </div>
        
        <div id="species_summary" class="column-right">
          <div id="species_names">
            <h3>All names</h3>' .
              $all_names .
          '</div>
        </div>
      </div>
      
      <div id="species_tabs" class="container">
        <ul class="css-tabs">
          <li><a href="' . $lib_rootURL . 
            'block/view_species/description.php?title=' . 
            str_replace(' ', '_', $this->data['name']) . '">Description</a></li>
          <li><a href="' . $lib_rootURL . 'block/view_species/range_map.php?id=' . 
            $this->data["id"] . '">Range map</a></li>
          <li><a href="ajax3.htm">Assessment</a></li>
        </ul>

        <div class="css-panes">
          <div></div>
          <div></div>
          <div></div>
        </div>

        <script>
            $(function() {
                $("ul.css-tabs").tabs("div.css-panes > div", {
	            effect: "default", history: true,
	            onBeforeClick: function(event, i) {

		        var pane = this.getPanes().eq(i);

		        if (pane.is(":empty")) {
		            pane.load(this.getTabs().eq(i).attr("href"));
		        }
	            }
	        });
            });
        </script>
      </div>
    </div>
    </body>' . "\n";
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

