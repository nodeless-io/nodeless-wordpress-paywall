<?php

// If this file is called directly, abort.
defined('WPINC') || die;

class NLPW_HelpPage extends NLPW_SettingsPage
{
    protected $settings_path = 'nlpw_settings_help';
    protected $option_name   = 'nlpw_paywall';
    protected $template_html = 'settings/page-help.php';

    /**
     * Make menu item/page title translatable
     */
    protected function set_translations()
    {
        // Menu Item label
        $this->page_title = __('Help', 'nodeless-paywall');
        $this->menu_title = __('Help', 'nodeless-paywall');
    }
}
