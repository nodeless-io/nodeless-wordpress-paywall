<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @since 1.0.0
 *
 * @package Nodeless_Paywall
 */

// If uninstall not called from WordPress, then exit.
if (! defined('WP_UNINSTALL_PLUGIN') ) {
    exit;
}

// Drop a custom database table
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}nodeless_paywall_payments");

delete_option( 'nlpw_connection' );
delete_option( 'nlpw_general' );
delete_option( 'nlpw_paywall' );
