<?php

/* File:            user_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the user view
 */

include_once dirname(__FILE__) . '/../../config/settings.php';

class userView {
  
  private $data = array();
  
  public function __construct($data) {
  // Default constructor
  // Param: $data is an array containing user data from inaturalist. See
  //        model for details.
  
    $this->data = $data;
  }
  
  public function html() {
  // Returns data in html format
  /*
    $html = '';
    foreach ($this->data as $key => $value) {
      echo "<b>$key</b> is $value</br>";
    }
  */
  
    global $lib_rootURL;
    
    return '
    <div class="page-container" id="view_user">
      <div class="container" id="user_badge">
		    <table width="100%">
				    <tr>
					    <td rowspan="2" width="48">
						    <img src="' . $this->data["user_icon_url"] .
						    '" class="userPic_thumb">
						  </td>
					    <td>' .
						    '<b>' . $this->data["login"] . '\'s profile</b>' .
						  '</td>
				    </tr>
				    <tr>
					    <td>
						    <a href=' . $this->data["uri"] . ' target="_blank">View on iNaturalist.org</a>
						  </td>
				    </tr>
		    </table>
		  </div>
		
		  <div class="container">
        <div id="user_desc" class="column-left">' .
          '<p><h3>About ' . $this->data["login"] . '</h3></p>' .
          '<p>' . $this->data["description"] . '</p>' .
        '</div>
            
        <div id="user_summary" class="column-right">
          <td width="25%">
            <img src="' . $this->data["original_user_icon_url"] . '" 
              class="userPic_orig"><br>
            <p>' .
              '<p>aka ' . $this->data["name"] . 
            '</p>' .
            '<p>
              Member since ' . substr( ($this->data["created_at"]),0,-15 ) . '<br>' .
              'Profile last updated ' . substr( ($this->data["updated_at_utc"]),0,-10 ) . '<br>' .
            '</p>
            <p>' .
              $this->data["observations_count"] . ' Observation(s)<br>' .
              $this->data["identifications_count"] . ' Identifications(s)<br>' .
              $this->data["journal_posts_count"] . ' Journal post(s)<br>' .
              $this->data["life_list_taxa_count"] . ' Species<br><br>
            </p>
          </td>
        </div>
      </div>
    </div>
    ';
  }
}

