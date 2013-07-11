<?php

/* File:            species_controller.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the species controller
 */

include_once dirname(__FILE__) . '/../model/species_model.class.php';
include_once dirname(__FILE__) . '/../view/species_view.class.php';

class speciesController {

  private $species;
  private $view;

  public function __construct($id) {
  // Default constructor - creates new model and view
    $this->species = new speciesModel($id);
    $this->view = new speciesView($this->species->data());
  }
  
  public function display() {
  // Calls view to display configured view
    echo $this->view->html();
  }
}
