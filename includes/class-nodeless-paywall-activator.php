<?php

// If this file is called directly, abort.
defined('WPINC') || die;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Nodeless_Paywall
 * @subpackage Nodeless_Paywall/includes
 */

// Custom Tables
require_once 'db/database-handler.php';

class Nodeless_Paywall_Activator
{

    /**
     * Setup necessary tables during plugin activation
     *
     * @since 1.0.0
     */
    public static function activate()
    {
        $database_handler = new NLPW_DatabaseHandler();
        $database_handler->init();
    }

}
