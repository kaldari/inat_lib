<?php

/* File:            this_user_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the this_user view
 */

include_once dirname(__FILE__) . '/../../config/settings.php';

class thisUserView {
  
  private $data;
  private $email;
  private $login;
  private $description;
  private $time_zone;
  
  public function __construct($data) {
  // Default constructor
  // Param: $data is an array containing user data from inaturalist. See
  //        model for details.
  
    $this->data = $data;
    $this->email = $data['email'];
    $this->login = $data['login'];
    $this->description = $data['description'];
    $this->time_zone = $data['time_zone'];
  }
  
  public function html() {
  // Returns data in html format
  
    $html = '';
    foreach ($this->data as $key => $value) {
      $html = $html . "<b>$key</b> is $value</br>";
    }
    return $html;
  }
  
  public function block() {
  // Returns data in html format
    if( !$this->user_isLogged_in() ) return;
    
    global $lib_rootURL;
    
    return
      "<div id='this_block'>
  		<table>
			<tbody>
			  <tr>
			    <td colspan='1' rowspan='3'>
			      <img src='". $this->data['medium_user_icon_url'] .
			      "' width='100px' height='100px'></img>
			    </td>
          <td>" .
            $this->data['login'] .
           "</td>
        </tr>
        <tr>
          <td>
            <a class='boxer button small' 
            href='" . $lib_rootURL . "block/this_user/viewUser.block.php'
              data-width='950' >View</a> | 
            <a class='boxer button small' 
            href='" . $lib_rootURL . "block/this_user/editUser.block.php'
              data-width='500' data-height='300' >Edit</a>
          </td>
				</tr>
				<tr>
					<td>
						<a href='' onclick='logout()'>
						  Logout
						</a>
          </td>
        </tr>
      </tbody>
    </table></body>
    </div>
    <script>
      function logout() {
      // PRE: User is logged in
      // POST: User is logged out
        $.removeCookie('inat_auth', { path: '/' });
        location.reload();
      }
    </script>";
  }
  
  public function viewUser() {
  // Returns data in html format
  
    global $lib_rootURL;
    
    /*
    $html = '';
    foreach ($this->data as $key => $value) {
      echo "<b>$key</b> is $value</br>";
    }
    */
    
    return '
    
		  <table width="100%">
				  <tr>
					  <td rowspan="2" width="48">
						  <img src="' . $this->data["user_icon_url"] . '" width="48"
						    height="48" border="1">
						</td>
					  <td>' .
						  '<b>' . $this->data["login"] . '</b>' . ' (' . $this->data["email"] . ')' .
						'</td>
				  </tr>
				  <tr>
					  <td>
						  Home | Observations | Calendar | Lists | Journal | ' . 
						    'Identifications | Projects | Profile
						</td>
				  </tr>
		  </table>
		
      <table width="100%">
        <tr>
        
          <td width="75%">' .
            $this->data["description"] . '<br>' .
          '</td>
          
          <td width="25%">
            <img src="' . $this->data["original_user_icon_url"] . '" 
              width="250" border="1" ><br>
            <p>' .
              'Member since ' . substr( ($this->data["created_at"]),0,-15 ) . '<br><br>' .
              $this->data["observations_count"] . ' Observation(s)<br>' .
              $this->data["life_list_taxa_count"] . ' Species<br><br>
              
              <a class="boxer button small" href="' . $lib_rootURL . 
                'block/this_user/editUser.block.php" data-width="500" 
                data-height="300" >Edit account</a>
            </p>
          </td>
          
        </tr>
      </table>
    ';
  }
  
  public function editUser() {
  // Returns data in html format
  
  global $lib_rootURL;
  
    return
    '<form action="' . $lib_rootURL . 'block/this_user/editUser.action.php" 
      method="post" id="form">
      <fieldset>
      <legend>Contact information</legend>
      <p>
        <label for="email">Email</label>
        <input type="text" name="email" size="30" class="required email" 
          value="' . $this->email . '"/>
        <!--Allowed values: Any valid email address.-->
      </p>
      </fieldset>
      
      <fieldset>
      <legend>Change password</legend>
      <p>
        <label for="password">New password</label>
        <input type="password" name="password" id="password" pattern=".{5,99}" />
        <!--Allowed values: Minimum 5 characters (this is not inat specified)-->
      </p>
      <p>
        <label for="password_confirmation">Password confirmation</label>
        <input type="password" equalto="#password" name="password_confirmation" />
        <!--Allowed values: Value matching id="password"-->
      </p>
      <p>
        <input type="submit" />
      </p>
      </fieldset>
    </form>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#form").validate();
      });
    </script>';
  }
  
  private function user_isLogged_in() {
  // Returns true if user is logged in, false otherwise
  
  if( isset($_COOKIE['inat_auth']) ) return true;
  return false;
  }
}

