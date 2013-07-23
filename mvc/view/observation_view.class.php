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
  
    // Display all available data -- use for development
    /*
    foreach ($this->data as $key => $value) {
      echo "<b>$key</b>: $value</br>";
    } echo '<hr>';
    */
    
    // Construct html list for photos
    $photos = "\n";
    $count = 0;
    foreach ($this->data["observation_photos"] as $key => $array) {
      if( ($count == 0) || (($count % 4) == 0) )
        $photos .= "\n<div>\n";
      $photos .= "<img src='" . $array['photo']['thumb_url'] . "' />\n";
      if( (($count+1) % 4) == 0 )
        $photos .= "</div>\n";
      $count++;
    }
    if( ($count % 4) != 0 )
      $photos .= "</div>\n\n";
    
    // Return formatted html
    return
    '<div class="page-container" id="view_obs">  
    <h2>' . 
      $this->data["species_guess"] . ' observed by ' . 
      $this->data["user_login"] . ' on ' . $this->data["observed_on"] . 
    '</h2>
      <div class="container">
		    <div id="left" class="column-left">
		      <div>
            <div id="image_wrap">
              <img src="/media/img/blank.gif" width="100%" height="375" />
            </div>

            <div>
            <a class="prev browse left"></a>
            <div class="scrollable" id="scrollable">
              <div class="items">' . $photos . '</div>
            </div>

            <a class="next browse right"></a>
            </div>
            <script>
            $(function() {
            $(".scrollable").scrollable();

            $(".items img").click(function() {
	            if ($(this).hasClass("active")) { return; }
	            var url = $(this).attr("src").replace("_t", "");
	            var wrap = $("#image_wrap").fadeTo("medium", 0.5);
	            var img = new Image();
	            img.onload = function() {
		            wrap.fadeTo("fast", 1);
		            wrap.find("img").attr("src", url);
	            };

	            img.src = url;
	            $(".items img").removeClass("active");
	            $(this).addClass("active");
            }).filter(":first").click();
            });
            </script>
		      </div>
		      <div>
		        <h3>Obs details</h3>
		        <p>Posted on ' . substr($this->data['created_at'], 0, -15) . 
		          ' by ' . $this->data["user_login"] . '<p>
		        <p>
		          <table id="obs_details">
              <tr>
                <th>Date observed</td>
                <th>Species guess</td>
                <th>Taxon</td>
              </tr>
              <tr>
                <td>' . $this->data['observed_on'] . '</td>
                <td>' . $this->data['species_guess'] . '</td>
                <td>' . $this->data['taxon_id'] . '</td>
              </tr>
              </table>
            </p>
		      </div>
		      <div>
		        <h3>Description</h3>
		        <p>' . $this->data['description'] . '</p>
		      </div>
		      <div>
		        <h3>Comments & identification</h3>
		      </div>
        </div>
        
        <div id="right" class="column-right">
          <div id="map-canvas" style="width: 100%; height: 400px">
            <script type="text/javascript"> 
              function initialize() {
                var myLatlng = new 
                  google.maps.LatLng(' . $this->data['latitude'] . ',' . 
                  $this->data['longitude'] . ');
                var mapOptions = {
                  zoom: 4,
                  center: myLatlng,
                  scrollwheel: false,
                  streetViewControl: false,
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
          <div>
            <h3>Additional fields (project)</h3>
          </div>
          <div>
            <h3>Data quality assessment</h3>
            <p>Quality grade: ' . $this->data["quality_grade"] . '</p>
          </div>
          <div>
            <h3>Notes about obs accuracy</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
      </div>
    </div>';
  }
}

