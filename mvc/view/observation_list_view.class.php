<?php

/* File:            obervation_list_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the observation list view
 */
 
include_once dirname(__FILE__) . '/../../config/settings.php';

class observationListView {
  
  private $data = array();
  
  public function __construct($data) {
  // Default constructor
  // Param: $data is an array containing observation list data from inaturalist.
  //        See model for details.  
  
    $this->data = $data;
  }
  
  public function html() {
  // Returns data in html format
  
    global $lib_rootURL;
  
    // Print headers
    $html = $html . "<table>";   
    $html = $html . '<th>' . "Posted" . '</th>';
    $html = $html . '<th>' . "User" . '</th>';
    $html = $html . '<th>' . "Species" . '</th>'; 
    $html = $html . '<th>' . "Profile" . '</th>'; 

    for($i=0; $i < count($this->data); $i++) {

      $html = $html . '<tr>';

      // Date posted column
      $html = $html . '<td>' . substr(($this->data[$i]['created_at']),0,-15) . '</td>';

      // User column
      $html = $html . '<td><a class="boxer button small" 
        href="' . $lib_rootURL . 'block/view_user/view_user.php?id=' .  
        $this->data[$i]['user_login'] . '"data-width="975">' . 
        $this->data[$i]['user_login'] . '</a></td>';

      // Obs column
      $html = $html . '<td><a class="boxer button small" 
        href="' . $lib_rootURL . 'block/view_observation/view_observation.php?id=' . 
        $this->data[$i]['id'] . '"data-width="975">' . 
        $this->data[$i]['species_guess'] . '</a></td>';
        
      // Species column
      $html = $html . '<td><a class="boxer button small" 
        href="' . $lib_rootURL . 'block/view_species/view_species.php?id=' . 
        $this->data[$i]['taxon_id'] . '"data-width="975">' .
        $this->data[$i]['taxon_id'] . '</a></td>';
        
      $html = $html . '</tr>';
    }
    $html = $html . '</table>';
    return $html;
  }
}

