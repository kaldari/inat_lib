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
      "<center>
      <div id='this_block'>
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
            href='" . $lib_rootURL . "block/this_user/viewUser.block.php'>View</a> | 
            <a class='boxer button small' 
            href='" . $lib_rootURL . "block/this_user/editUser.block.php'>Edit</a>
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

    </center>";
  }
  
  public function viewUser() {
  // Returns data in html format
  
    $html = '';
    foreach ($this->data as $key => $value) {
      $html = $html . "<b>$key</b> is $value</br>";
    }
    return $html;
  }
  
  public function editUser() {
  // Returns data in html format
  
  global $lib_rootURL;
  
    return
    '<form action="' . $lib_rootURL . 'block/this_user/editUser.action.php" 
      method="post" id="form">
      <p>
        <label for="email">Email</label>
        <input type="text" name="email" size="30" class="required email" 
          value="' . $this->email . '"/>
        <!--Allowed values: Any valid email address.-->
      </p>
      <p>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" pattern=".{5,}" class="password" />
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
    </form>';
  }
  
  private function user_isLogged_in() {
  // Returns true if user is logged in, false otherwise
  
  if( isset($_COOKIE['inat_auth']) ) return true;
  return false;
  }
}

