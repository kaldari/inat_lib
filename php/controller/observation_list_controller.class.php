<?php

/* File:            species_controller.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the species controller
 */

include_once dirname(__FILE__) . '/../model/observation_list_model.class.php';
include_once dirname(__FILE__) . '/../view/observation_list_view.class.php';

class observationListController {

  private $model;
  private $view;

  public function __construct($type, $id) {
  // Default constructor - creates new model and view

    $this->model = new observationListModel($type, $id);
    $this->view = new observationListView($this->model->data());
  }
  
  public function display() {
  // Calls view to display configured view
    echo $this->view->html();
  }
}

