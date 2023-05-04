<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since   1.0.0
 * @package Nodeless_Paywall
 *
 * @wordpress-plugin
 * Plugin Name:       Nodeless Paywall
 * Description:       Nodeless Paywall is a Paywall and Donation plugin for WordPress to accept instant Bitcoin Lightning payments and donations directly to your preferred wallet.
 * Version:           1.0.6
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       nodeless-paywall
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC') ) {
    die;
}

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define('NODELESSIO_PW_VERSION', '1.0.6');
define('NODELESSIO_PW_PAYWALL_JWT_KEY', hash_hmac('sha256', 'nodeless-paywall', AUTH_KEY));
define('NODELESSIO_PW_PAYWALL_JWT_ALGORITHM', 'HS256');
define('NODELESSIO_PW_ROOT_PATH', untrailingslashit(plugin_dir_path(__FILE__)));
define('NODELESSIO_PW_ROOT_URI', untrailingslashit(plugin_dir_url(__FILE__)));
define('NODELESSIO_PW_POST_META_PAYWALL_ID', 'nodeless_paywall_id');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nodeless-paywall-activator.php
 */
function activate_nodeless_paywall()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-nodeless-paywall-activator.php';
    Nodeless_Paywall_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nodeless-paywall-deactivator.php
 */
function deactivate_nodeless_paywall()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-nodeless-paywall-deactivator.php';
    Nodeless_Paywall_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_nodeless_paywall');
register_deactivation_hook(__FILE__, 'deactivate_nodeless_paywall');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-nodeless-paywall.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_nodeless_paywall()
{

    $plugin = new Nodeless_Paywall();
    $plugin->run();
}
run_nodeless_paywall();
