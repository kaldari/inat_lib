<?php

/* File:            field.class.php
 * Author:          Kyle Garsuta
 * Created:         9 Jul 2013
 *
 * Description:     
 */

class field {

  public function __construct($project = NULL) {
  // Default constructor

  }

  public function getName($id = NULL) {
  // Returns readable name of field with input id

    $field_name;
    $data = $this->http_get("http://www.inaturalist.org/projects/iseahorse.json");
    $data = json_decode($data, true);

    for($i=0; $i < count($data['project_observation_fields']); $i++) {
      if($data['project_observation_fields'][$i]['observation_field_id'] == $id)
        $field_name = $data['project_observation_fields'][$i]['observation_field']['name'];
    }

    return $field_name;
  }

  private function http_get($url){
  // A helper function that GETs the input url
  // POST: Returns server response
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
}

$obs_list = new field();
echo $obs_list->getName(405);











