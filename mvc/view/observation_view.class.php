<?php

/* File:            observation_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the observation view
 */

class observationView {
  
  private $data = array();
  
  public function __construct($data) {
  // Default constructor
  // Param: $data is an array containing observation data from inaturalist. See
  //        model for details.  

    $this->data = $data;
  }
  
  public function html() {
  // Returns data in html format
  
    foreach ($this->data as $key => $value) {
      echo "<b>$key</b> is $value</br>";
    }
       echo '<hr>';
    
    $id = $this->data['id'];
    $range_kmz = "http://www.inaturalist.org/taxa/$id/range.kml";
    
    foreach ($this->data["observation_photos"] as $key => $array) {
      echo $array['photo']['large_url'];
    }
    
    return
    '<div class="page-container" id="view_obs">  
      <div class="container">
		    <div id="left" class="column-left">
		      <div>Photo</div>
		      <div>Obs details</div>
		      <div>
		        <h3>Description</h3>
		        <p>' . $this->data['description'] . '</p>
		      </div>
		      <div>Comments & identification</div>
        </div>
        
        <div id="right" class="column-right">
          <div id="map-canvas" style="width: 100%; height: 300px">
            <script type="text/javascript"> 
              function initialize() {
                var myLatlng = new 
                  google.maps.LatLng(' . $this->data['latitude'] . ',' . 
                  $this->data['longitude'] . ');
                var mapOptions = {
                  zoom: 4,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: "Hello World!"
                });
              }
              google.maps.event.addDomListener(window, "load", initialize);
            </script>
          </div>
          <div>Other photos</div>
          <div>Identification summary</div>
          <div>Data quality assessment</div>
          <div>Small point about innacurate obs</div>
        </div>
      </div>
    </div>';
  }
}

