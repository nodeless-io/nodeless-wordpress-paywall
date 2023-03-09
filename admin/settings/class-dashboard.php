<?php

// If this file is called directly, abort.
defined('WPINC') || die;

class NLPW_Dashboard extends NLPW_SettingsPage
{
    protected $settings_path = 'nlpw_settings';
    protected $option_name   = 'NLPW_Dashboard';
    protected $template_html = 'settings/page-dashboard.php';

    /**
     * Make menu item/page title translatable
     */
    protected function set_translations()
    {
        // Menu Item label
        $this->page_title = __('Dashboard', 'nodeless-paywall');
        $this->menu_title = __('Dashboard', 'nodeless-paywall');
    }

    /**
     * Get the total payments made
     */
    public function get_total_payments()
    {
        $database_handler = $this->plugin->getDatabaseHandler();
        return $database_handler->total_payment_count('settled');
    }

    /**
     * Get the total payments sum
     */
    public function get_total_payments_sum()
    {
        $database_handler = $this->plugin->getDatabaseHandler();
        return $database_handler->total_payment_sum();
    }

    /**
     * Get the top posts
     */
    public function get_top_posts()
    {
        $database_handler = $this->plugin->getDatabaseHandler();
        $top_posts = $database_handler->top_posts();
        return $top_posts;
    }

    /**
     * Get the connected wallet
     */
    public function get_connected_wallet()
    {
        try {
            if ($this->check_connection_valid()) {
                $node_info = $this->plugin->getLightningClient()->getInfo();
                $message = sprintf(
                    '%s %s - %s',
                    __('Connected to:', 'nodeless-paywall'),
                    $node_info['alias'],
                    $node_info['identity_pubkey']
                );
            }
            else {
                $message = __('Wallet not connected', 'nodeless-paywall');
            }
            return $message;
        } catch (\Exception $e) {
            return sprintf(
                '%s %s',
                __('Connection Error', 'nodeless-paywall'),
                $e
            );
        }
    }

    /**
     * Check if connection is valid
     */
    public function check_connection_valid() {
        try {
            return $this->plugin->getLightningClient()
                && $this->plugin->getLightningClient()->isConnectionValid();
        } catch (\Exception $e) {
            echo "Failed to validate Lightning Wallet connection" . $e->getMessage();
            return false;
        }
    }
}
