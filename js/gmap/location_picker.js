/* File:            location_picker.js
 * Author:          Kyle Garsuta
 * Created:         5 Jul 2013
 *
 * Description:     
 *  This script generates the gmap picker
 *  useed on the add obs page
 */

// configuration
var myZoom = 1;
var myCoordsLenght = 5;
var defaultLat = "";
var defaultLng = "";

// creates the map
// zooms
// centers the map
// sets the map's type 
var map = new google.maps.Map(document.getElementById('gmap_picker'), {
	zoom: myZoom,
	center: new google.maps.LatLng(defaultLat, defaultLng),
  scrollwheel: false,
	mapTypeId: google.maps.MapTypeId.ROADMAP
});

var myMarker;

function placeMarker(location) {
// Create/update marker at the given location
  if ( myMarker ) {
    myMarker.setPosition(location);
  } else {
    myMarker = new google.maps.Marker({
      position: location,
      draggable: true,
      map: map
    });
  }
}

function manualLatLongInput() {
// Create/update marker on manual user lat/long input
  inLat = document.getElementById('latitude_stndrd').value;
  inLong = document.getElementById('longitude_stndrd').value;
  inLatLong = new google.maps.LatLng(inLat,inLong);
  placeMarker(inLatLong);
}

// Listener - on click
// Update lat/long coordinates on click
google.maps.event.addListener(map, 'click', function(event) {
  placeMarker(event.latLng);
  document.getElementById('latitude_stndrd').value = event.latLng.lat().toFixed(myCoordsLenght);
	document.getElementById('longitude_stndrd').value = event.latLng.lng().toFixed(myCoordsLenght);
  
  // Listener - on drag
  // Update lat/long coordinates on drag
  google.maps.event.addListener(myMarker, 'drag', function(evt) {
	  document.getElementById('latitude_stndrd').value = evt.latLng.lat().toFixed(myCoordsLenght);
	  document.getElementById('longitude_stndrd').value = evt.latLng.lng().toFixed(myCoordsLenght);
  });
});

// Listener - listen for manual lat/long input
// Update map on manual user input
google.maps.event.addDomListener(document.getElementById('latitude_stndrd'), 'change', function() {
  manualLatLongInput();
});

// Listener - listen for manual lat/long input
// Update map on manual user input
google.maps.event.addDomListener(document.getElementById('longitude_stndrd'), 'change', function() {
  manualLatLongInput();
});
