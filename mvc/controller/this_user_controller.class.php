<?php

/* File:            this_user_controller.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the this_user controller
 */

include_once dirname(__FILE__) . '/../model/this_user_model.class.php';
include_once dirname(__FILE__) . '/../view/this_user_view.class.php';

class thisUserController {

  private $model;
  private $view;

  public function __construct() {
  // Default constructor - creates new model and view
    $this->model = new thisUserModel();
    $this->view = new thisUserView($this->model->data());
  }
  
  public function edit_user($data) {
    $this->model->edit_user($data);
  }
  
  public function display() {
  // Calls view to display configured view
    echo $this->view->html();
  }
  
  public function display_block() {
  // Calls view to display configured view
    echo $this->view->block();
  }
  
  public function display_viewUser() {
  // Calls view to display configured view
    echo $this->view->viewUser();
  }

  public function display_editUser() {
  // Calls view to display configured view
    echo $this->view->editUser();
  }
}

