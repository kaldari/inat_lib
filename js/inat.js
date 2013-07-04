function json_to_obj(url) {
// A helper function that reads a local
// json file and returns the corresponding
// js object
//
// PRE: Valid local json file
// POST: Returns js object
  
  // Read local project.json file
  var request = new XMLHttpRequest();
  request.open( "GET", url, false );
  // Same origin policy won't allow external url
  // Would be ideal to find a way to implement this later

  request.setRequestHeader("User-Agent",navigator.userAgent);
  request.send(null);
  var json = (request.responseText);

  return JSON.parse(json);
}

function obj_to_html_fields(obj) {
// A function that takes a js object
// then converts the fields to corresonding
// html fields
//
// PRE: Valid inat project object 
//  (e.g. from inaturalist.org/projects/iSeahorse.json)
// POST: Returns html form equivalent
  var html = "";
  var i = 0;
  while( i <= 21 ) {

    html = html + "<p>\n";

    // <label for="field_id">field_name</label>
    html = html + "<label for='" +
      obj.project_observation_fields[i].observation_field.id + "'>" + 
      obj.project_observation_fields[i].observation_field.name + "</label>\n";

    if( obj.project_observation_fields[i].observation_field.allowed_values == "" ) {
    // If text field
      
      // <input type="text" name="field_id" ></input>
      html = html + "<input type='text' name='" +
        obj.project_observation_fields[i].observation_field.id + "'></input>\n";
    } else {
    // Else if dropdown list - assume iNat only has text fields OR dropdown lists
      
      // <select name="field_id"/>
      html = html + "<select name='" + 
        obj.project_observation_fields[i].observation_field.id + "'";
      
      if(obj.project_observation_fields[i].required) html = html + "required";
    
      html = html + "/>";
      
      // Convert delimitted option values into an array
      var options = obj.project_observation_fields[i].observation_field.allowed_values.split("|");

      for(x=0; x < options.length; x++) {
        //<option value="Hippocampus abdominalis">Hippocampus abdominalis</option>
        html = html + "<option value='" + options[x] + "'>" + options[x] + "</option>";
      }
      
      html = html + "</select>";
    }

    html = html + "</p>\n";
    i += 1;
  }
  return html;
}
