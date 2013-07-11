<?php

/* File:            user_controller.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the user controller
 */

include_once dirname(__FILE__) . '/../model/user_model.class.php';
include_once dirname(__FILE__) . '/../view/user_view.class.php';

class userController {

  private $model;
  private $view;

  public function __construct($id) {
  // Default constructor - creates new model and view
    $this->model = new userModel($id);
    $this->view = new userView($this->model->data());
  }
  
  public function display() {
  // Calls view to display configured view
    echo $this->view->html();
  }
}

