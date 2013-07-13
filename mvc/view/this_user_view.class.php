<?php

/* File:            this_user_view.class.php
 * Author:          Kyle Garsuta
 * Created:         12 Jul 2013
 * 
 * Description      This file defines the this_user view
 */

class thisUserView {
  
  private $data;
  private $email;
  private $login;
  private $password;
  private $password_confirm;
  private $description;
  private $time_zone;
  
  public function __construct($data) {
  // Default constructor
  // Param: $data is an array containing user data from inaturalist. See
  //        model for details.
  
    $this->data = $data;
    $this->email = $data['email'];
    $this->login = $data['login'];
    $this->password = $data['password'];
    $this->password_confirm = $data['password_confirm'];
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
  
  public function editUser() {
  // Returns data in html format
  
    return
      "<form action='mvc/action/add_obs.php' method='post' id='form' enctype='multipart/form-data'>
      <fieldset id='stndrd_fields'>
      
      <p><img src='" . $this->data['user_icon_url'] . "' ></p>" .
      "<p>
        Username: " . $this->data['login'] .
      "</p>
      <p>
        <label for='password'>Password</label>
        <input type='password' name='password' id='password' pattern='.{5,}' class='required password' />
      </p>
      <p>
        <label for='password_confirmation'>Password confirmation</label>
        <input type='password' equalto='#password' name='password_confirmation' />
      </p>" .
      "<p>
        <label for='description_stndrd'></label>
        <textarea name='description_stndrd' cols='50' rows='5' placeholder='Description'></textarea>
      </p>
      <p>
        <input type='submit' />
      </p>
      </fieldset>
      </form>";
  }
  
  public function block() {
  // Returns data in html format
    if( !$this->user_isLogged_in() ) return;
    
    return
      "<script src='../../js/jquery/jquery-1.10.1.min.js'></script>
      <script src='../../js/jquery/plugins/jquery-cookie-master/jquery.cookie.js'></script>
      <script>
        function logout() {
        // PRE: User is logged in
        // POST: User is logged out
          $.removeCookie('inat_auth', { path: '/' });
          location.reload();
        }
      </script>
      
      <center>
      <div id='this_block'>
  		<table border='0' cellpadding='0' cellspacing='0' style='width: 200px;'>
			<tbody>
			  <tr>
			    <td colspan='1' rowspan='3'>
			      <img src='". $this->data['user_icon_url'] .
			      "' width='100px' height='100px'></img>
			    </td>
          <td>" .
            $this->data['login'] .
           "</td>
        </tr>
        <tr>
          <td>
            View | Edit
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
      // Displays/hides items as accordingly (e.g. hide login if already logged in)
      if(typeof $.cookie('inat_auth') != 'undefined') {
      } else {
        document.getElementById('this_block').style.display='none';
      }
    </script>
    </center>";
  }
  
  private function user_isLogged_in() {
  // Returns true if user is logged in, false otherwise
  
  if( isset($_COOKIE['inat_auth']) ) return true;
  return false;
  }
}

