<?php

/* File:            obervation_list_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the species controller
 */

class observationListView {
  
  private $data = array();
  
  public function __construct($data) {
    $this->data = $data;
  }
  
  public function html() {
  // Displays data in html format
  
    // Print headers
    $html = $html . "<table>";   
    $html = $html . '<th>' . "Posted" . '</th>';
    $html = $html . '<th>' . "User" . '</th>';
    $html = $html . '<th>' . "Species" . '</th>'; 
    $html = $html . '<th>' . "Profile" . '</th>'; 

    for($i=0; $i < count($this->data); $i++) {

      $html = $html . '<tr>';

      // Date posted column
      $html = $html . '<td>' . $this->data[$i]['created_at'] . '</td>';

      // User column
      $html = $html . '<td>' . '<a rel = "#mies1" href=""' . 'onClick = "view_user(' . 
        $this->data[$i]['user_id'] . ')">' . $this->data[$i]['user_login'] . '</a></td>';

      // Obs column
      $html = $html . '<td>' . '<a rel = "#mies1" href=""' . 'onClick = "view_obs(' . 
        $this->data[$i]['id'] . ')">' . $this->data[$i]['species_guess'] . '</a></td>';
        
      // Species column
      $html = $html . '<td>' . '<a rel = "#mies1" href=""' . 'onClick = "view_species(' . 
        $this->data[$i]['taxon_id'] . ')">' . $this->data[$i]['taxon_id'] . '</a></td>';
        
      $html = $html . '</tr>';
    }
    $html = $html . '</table>';
    return $html;
  }
}

