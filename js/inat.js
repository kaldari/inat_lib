/* File:            inat.js
 * Author:          Kyle Garsuta
 * Created:         19 Jun 2013
 * Last modified:   21 Jun 2013 by Kyle
 * PRE:             User has granted access and OAuth2 token is appended
 *                     on callback query string
 * POST:            OAuth 2.0 token is stored in 'inat_auth' cookie
 *
 * Description:     
 *  This program extracts the OAuth2 token from the callback
 *  query string and stores it in 'inat_auth' cookie
 *
 *  See iNat API Reference: http://www.inaturalist.org/pages/api+reference
 *
 *  This program is in the early stages of development and serves as a rudimentary proof
 *  of concept.
 */


function redirect(redirect_url){
  window.location = redirect_url;
}

function authenticate(client_id, redirect_url){
  window.location = "https://www.inaturalist.org/oauth/authorize?client_id=" + client_id + 
    "&redirect_uri=" + escape(redirect_url) + "&response_type=token";
}

function callback(redirect_url){
  // Parse the query string
  var queryString = location.hash.substring(14);
  var token = queryString.substring(0, queryString.length - 18);

  // need to implement error checking

  // Store token in a cookie
  // better to store in a session?
  var cookie_name = "inat_auth";
  var ex_days = 7;
  var ex_date=new Date();
  ex_date.setDate(ex_date.getDate() + ex_days);
  var cookie_value=escape(token) + ((ex_days==null) ? "" : "; expires="+ex_date.toUTCString());
  document.cookie=cookie_name + "=" + cookie_value;

  // Redirect to homepage once token has been saved
  window.location = redirect_url;
}
