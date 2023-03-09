<?php

// If this file is called directly, abort. xxx
defined('WPINC') || die;

class NLPW_BalancePage extends NLPW_SettingsPage
{
    protected $settings_path = 'nlpw_settings_balances';
    protected $option_name   = 'nlpw_paywall';
    protected $template_html = 'settings/page-balance.php';

    protected $database_handler;

    public function __construct($plugin, $page, $database_handler)
    {
        parent::__construct($plugin, $page);
        $this->database_handler = $database_handler;
    }

    /**
     * Make menu item/page title translatable
     */
    protected function set_translations()
    {
        // Menu Item label
        $this->page_title = __('Transactions', 'nodeless-paywall');
        $this->menu_title = __('Transactions', 'nodeless-paywall');
    }
}
