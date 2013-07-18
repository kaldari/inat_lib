<?php

  include_once dirname(__FILE__) . '/../../config/settings.php';
  global $lib_rootURL;
  
  echo
  '<html>
  <body>
    <form action="' . $lib_rootURL . 
      'block/register/register.action.php' . '" method="post" id="form">
      <fieldset>
        <legend>Registration</legend>
        <p>
          <label for="login">Login/username</label>
          <input type="text" name="login"size="30" pattern=".{3,40}" required 
            autocomplete="on" />
          <!--Allowed values: Must be within 3 and 40 characters and must not begin with a number.-->
        </p>
        <p>
          <label for="email">Email</label>
          <input type="email" name="email" size="30" required 
            autocomplete="on" />
          <!--Allowed values: Any valid email address.-->
        </p>
        <p>
          <label for="password">Password</label>
          <input type="password" name="password" id="password" pattern=".{5,}" required />
          <!--Allowed values: Minimum 5 characters (this is not inat specified)-->
        </p>
        <p>
          <label for="password_confirmation">Password confirmation</label>
          <input type="password" equalto="#password" name="password_confirmation
          id="password_confirmation" />
          <!--Allowed values: Value matching id="password"-->
        </p>
        <p>
          <input type="checkbox" name="terms" required />
            I agree to the terms and conditions<br>
            <!--Terms and conditions link need to be added here-->
        </p>
        <p>
          <input type="submit"/>
        </p>
      </fieldset>
  </form>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#form").validate();
    });
  </script>
  </body>
  </html>';
?>
