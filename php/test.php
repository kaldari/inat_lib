<?php

include_once dirname(__FILE__) . '/controller/observation_list_controller.class.php';

$controller = new observationListController('project', 'iseahorse');
$controller->display();

?>

