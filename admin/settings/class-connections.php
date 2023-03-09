<?php

// If this file is called directly, abort. xxx
defined('WPINC') || die;

class NLPW_ConnectionPage extends NLPW_SettingsPage
{
    protected $settings_path = 'nlpw_settings_connections';
    protected $template_html = 'settings/page-connections.php';
    protected $option_name   = 'nlpw_connection';

    /**
     * Make menu item/page title translatable
     */
    protected function set_translations()
    {
        // Menu Item label
        $this->page_title = __('Connection Settings', 'nodeless-paywall');
        $this->menu_title = __('Connection Settings', 'nodeless-paywall');

        add_action('admin_notices', array($this, 'get_ln_node_info'));
    }


    /**
     * Register Tabs if any
     *
     * @return [type] [description]
     */
    public function init_fields()
    {
        // Tabs
        $this->tabs = array(
            'nodeless' => array(
                'title'       => __('Nodeless.io', 'nodeless-paywall'),
                'description' => __('Connect to Nodeless.io.', 'nodeless-paywall'),
            ),
        );

        parent::init_fields();
    }


    /**
     * Array of form fields available on this page
     */
    public function set_form_fields()
    {

        /**
         * Fields
         */
        $fields = array();

        /**
         * Nodeless.io
         */
        $fields[] = array(
            'tab'     => 'nodeless',
            'field'   => array(
                'type'        => 'url',
                'name'        => 'nodeless_host',
                'label'       => __('Host', 'nodeless-paywall'),
                'description' => __('Nodeless.io host, will be replaced by Live/Testnet dropdown', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'nodeless',
            'field'   => array(
                'name'        => 'nodeless_apikey',
                'label'       => __('API Key', 'nodeless-paywall'),
                'description' => __('Nodeless.io Api Key.', 'nodeless-paywall'),
            ),
        );

        // Save Form fields to class
        $this->form_fields = $fields;
    }

    public function get_ln_node_info()
    {

        // Don't run check on other settings pages
        if (! $this->is_current_page() ) {
            return;
        }

        try {

            if ($this->plugin->getLightningClient()
                && $this->plugin->getLightningClient()->isConnectionValid()
            ) {
                $node_info = $this->plugin->getLightningClient()->getInfo();

                $type    = 'notice';
                $message = sprintf(
                    '%s %s - %s',
                    __('Connected to:', 'nodeless-paywall'),
                    $node_info['alias'],
                    $node_info['identity_pubkey']
                );
            }
            else {

                $type    = 'error';
                $message = __('Wallet not connected', 'nodeless-paywall');
            }
        }
        catch (\Exception $e) {

            $type    = 'error';
            $message = sprintf(
                '%s %s',
                __('Connection Error, please check log for details', 'nodeless-paywall'),
                $e
            );
        }

        $this->add_admin_notice($message, $type);
    }

    /**
     * Get the active tab based on the wallet setting saved in the database
     * Overrides the parent method
     */
    public function get_active_tab_id()
    {
        $connection_options = $this->plugin->getConnectionOptions();
        if (!empty($connection_options['nodeless_host'])) {
            return 'nodeless';
        } else {
            return isset($_GET['tab'])
                ? sanitize_text_field($_GET['tab'])
                : key($this->tabs);
        }
    }
}
