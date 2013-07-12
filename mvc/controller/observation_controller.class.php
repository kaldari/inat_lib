<?php

/* File:            species_controller.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the species controller
 */

include_once dirname(__FILE__) . '/../model/observation_model.class.php';
include_once dirname(__FILE__) . '/../view/observation_view.class.php';

class observationController {

  private $model;
  private $view;

  public function __construct($id) {
  // Default constructor - creates new model and view

    $this->model = new observationModel($id);
    $this->view = new observationView($this->model->data());
  }
  
  public function display() {
  // Calls view to display configured view
    echo $this->view->html();
  }
}

