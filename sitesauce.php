<?php

/**
 * Plugin Name: Sitesauce - Extra Saucy 
 * Description: Keep Sitesauce in sync with your Wordpress content. Based on the official Sitesauce plugin with extra sauce.
 * Author: Miguel Piedrafita
 * Author URI: https://mattdoesdev.com
 * Plugin URI: https://mattdoesdev.com
 * Version: 1.2.0
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SITESAUCE_DEPLOYMENTS_FILE', __FILE__);
define('SITESAUCE_DEPLOYMENTS_PATH', untrailingslashit(plugin_dir_path(__FILE__)));
define('SITESAUCE_DEPLOYMENTS_URL', untrailingslashit(plugin_dir_url(__FILE__)));

require_once(SITESAUCE_DEPLOYMENTS_PATH.'/src/App.php');

function Sitesauce()
{
    return Sitesauce\Wordpress\App::instance();
}

register_activation_hook(SITESAUCE_DEPLOYMENTS_FILE, [Sitesauce(), 'activation']);

register_deactivation_hook(SITESAUCE_DEPLOYMENTS_FILE, [Sitesauce(), 'deactivation']);
