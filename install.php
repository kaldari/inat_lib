<?php

/* File:            install.php
 * Author:          Kyle Garsuta
 * Created:         17 Jul 2013
 *
 * Run this file for any new inat_lib install
 */

// PHP opening tag
$config_data = '<?php' . "\r\n";
$settings_file = '.config/settings.php';

// Get the url of the inat_lib root directory
$this_page = basename($_SERVER['REQUEST_URI']);
if (strpos($this_page, "?") !== false) $this_page = 
  reset(explode("?", $this_page));
  
// $lib_rootURL
$config_data .= '$lib_rootURL = "' . 
  substr("http://$_SERVER[HTTP_HOST]" . 
  "$_SERVER[REQUEST_URI]", 0, -strlen($this_page)) . '";' . "\r\n";

// PHP closing tag
$config_data .= '?>';

// Print to file
// Let's make sure the file exists and is writable first.
if (is_writable($settings_file)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($settings_file, 'w')) {
         echo "Cannot open file ($settings_file)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $config_data) === FALSE) {
        echo "Cannot write to file ($settings_file)";
        exit;
    }

    echo "Success, wrote ($config_data) to file ($settings_file)";

    fclose($handle);

} else {
    echo "The file $settings_file is not writable";
}
?>
