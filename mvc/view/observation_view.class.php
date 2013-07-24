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
    
    $data = $this->data;
    
    // Observation title
    $author_date = 'Posted by ' . 
      $data["user_login"] . 
      ($data["created_at"] ? (' on ' . substr($data["created_at"], 0, -15)) : '' );
    
    // Construct html list for photos
    $photos = "\n";
    $count = 0;
    foreach ($data["observation_photos"] as $key => $array) {
      if( ($count == 0) || (($count % 4) == 0) )
        $photos .= "\n<div>\n";
      $photos .= "<img class='obs_photo_t' src='" . $array['photo']['large_url'] . "' />\n";
      if( (($count+1) % 4) == 0 )
        $photos .= "</div>\n";
      $count++;
    }
    if( ($count % 4) != 0 )
      $photos .= "</div>\n\n";
    
    // Geoprivacy
    $geoprivacy = 
      $data['geoprivacy'] ? $data['geoprivacy'] : 'open';
    
    // Return formatted html
    return
    '<div class="page-container" id="view_obs">
      <div id="obs_navigation">
        <p>Previous | Next</p>
      </div>
      <div class="container">
		    <div id="left" class="column-left">
		      <div>
            <div id="image_wrap">
              <img class="obs_photo_l" src=""/>
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
		        <h3>Observation details</h3>
		          <p>' . $author_date . '</p>
		          <table id="obs_details">
              <tr>
                <th>Date observed</td>
                <th>Species guess</td>
              </tr>
              <tr>
                <td>' . $data['observed_on'] . '</td>
                <td>' . $data['species_guess'] . '</td>
              </tr>
              </table>
            </p>
		      </div>
		      <div>
		        <h3>Description</h3>
		        <p>' . $data['description'] . '</p>
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
                  google.maps.LatLng(' . $data['latitude'] . ',' . 
                  $data['longitude'] . ');
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
            <p><b>Geoprivacy:</b> ' . $geoprivacy . '<p>
          </div>
          <div>
            <p><b>Quality grade:</b> ' . $data["quality_grade"] . '</p>
          </div>
          <div>
            <h3>Additional details</h3>
          </div>
        </div>
      </div>
    </div>';
  }
}

