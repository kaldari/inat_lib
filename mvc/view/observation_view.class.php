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
		      <div>
		      
		      
		      
		      
		      
<div id="image_wrap">
  <img src="/media/img/blank.gif" width="100%" height="375" />
</div>

<div style="margin:0 auto; width: 634px; height:120px;">
<a class="prev browse left"></a>
<div class="scrollable" id="scrollable">
  <div class="items">
  
    <div>
      <img src="http://farm1.static.flickr.com/143/321464099_a7cfcb95cf_t.jpg" />
      <img src="http://farm4.static.flickr.com/3089/2796719087_c3ee89a730_t.jpg" />
      <img src="http://farm1.static.flickr.com/79/244441862_08ec9b6b49_t.jpg" />
      <img src="http://farm1.static.flickr.com/28/66523124_b468cf4978_t.jpg" />
    </div>
    
    <div>
      <img src="http://farm1.static.flickr.com/163/399223609_db47d35b7c_t.jpg" />
      <img src="http://farm1.static.flickr.com/135/321464104_c010dbf34c_t.jpg" />
      <img src="http://farm1.static.flickr.com/40/117346184_9760f3aabc_t.jpg" />
      <img src="http://farm1.static.flickr.com/153/399232237_6928a527c1_t.jpg" />
    </div>

    <div>
      <img src="http://farm4.static.flickr.com/3629/3323896446_3b87a8bf75_t.jpg" />
      <img src="http://farm4.static.flickr.com/3023/3323897466_e61624f6de_t.jpg" />
      <img src="http://farm4.static.flickr.com/3650/3323058611_d35c894fab_t.jpg" />
      <img src="http://farm4.static.flickr.com/3635/3323893254_3183671257_t.jpg" />
    </div>

  </div>

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
		      <div>Obs details</div>
		      <div>
		        <h3>Description</h3>
		        <p>' . $this->data['description'] . '</p>
		      </div>
		      <div>Comments & identification</div>
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
          <div>Other photos</div>
          <div>Identification summary</div>
          <div>Data quality assessment</div>
          <div>Small point about innacurate obs</div>
        </div>
      </div>
    </div>';
  }
}

