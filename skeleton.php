<?php

/*
 * Plugin Name:
 * Version: _version
 * Plugin URI:
 * Description:
 * Author:
 * Author URI: 
 */

require_once('vendor/autoload.php');

use Nodopiano\ExamplePlugin\MainClass;

/* $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://your-plugin-repository',
    __FILE__,
    'your-plugin-slug'
); */

new MainClass(plugin_dir_path(__FILE__), plugin_dir_url(__FILE__));