<?php 
/*
Plugin Name: RStream
Plugin URI: https://abdursoft.com/plugin/rstream
Description: RStream plugin make your video embedded system easier. Just create a shortcode and use anywhere.
Version: 1.0.0
Author: abdurSoft
Author URI: https://abdursoft.com/about
License: GPLv2 or Later
Text Domain: abdurSoft
*/

use Abdur\RStream\Class\Action;

ini_set('display_errors', 1);
ini_set('error_reporting',1);

// load the autoloader from vendor
require __DIR__ . "/vendor/autoload.php";

// // loading functions for this plugin
require __DIR__ . "/src/Class/Helper.php";

// // Define plugins directory and url 

define('RSTREAM_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__)); //Plugin Directory
define('RSTREAM_PLUGIN_URL', plugins_url()."/rstream"); // Plugin URI
define("RSTREAM_PLUGIN_VERSION",'1.0.0'); //Plugin Version

// install the plugin and create tables
register_activation_hook(__FILE__, 'rstream_install_hook');

// uninstall plugin and drop tables
register_uninstall_hook(__FILE__, 'rstream_uninstall_hook');

new Action();
