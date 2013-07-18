<?php

  include_once dirname(__FILE__) . '/../../config/settings.php';
  global $lib_rootURL;
  
  echo
  '<form action="' . $lib_rootURL . 'block/login/login.action.php' . '" method="post" id="form">
    <legend>Login to iNaturalist</legend>
    <p>
      <label for="login">Username</label>
      <input type="text" name="login" pattern=".{3,40}" required />
      <!--Allowed values: Must be within 3 and 40 characters and must not begin with a number.-->
    </p>
    <p>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" pattern=".{5,}" required />
      <!--Allowed values: Minimum 5 characters (this is not inat specified)-->
    </p>
    <p>
      <a href="' . $lib_rootURL . 'block/register/register.block.php' . 
        '" class="boxer button small">Create a new account</a><br>
      <a href="http://www.inaturalist.org/users/password/new" 
        class="boxer button small">Request a new password</a>
    </p>
    <p>
      <input type="submit"/>
    </p>
  </form>';
?>
