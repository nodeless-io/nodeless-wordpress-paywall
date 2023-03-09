<?php

// If this file is called directly, abort.
defined('WPINC') || die;

class NLPW_PaywallPage extends NLPW_SettingsPage
{
    protected $settings_path = 'nlpw_settings_paywall';
    protected $template_html = 'settings/page-paywall.php';
    protected $option_name   = 'nlpw_paywall';

    public function init_fields()
    {
        // Tabs
        $this->tabs   = array(
            'paywall' => array(
                'title' => __('Paywall', 'nodeless-paywall'),
            ),
            'advanced' => array(
                'title' => __('Advanced', 'nodeless-paywall'),
            ),
        );

        parent::init_fields();
    }


    /**
     * Make menu item/page title translatable
     */
    protected function set_translations()
    {
        // Menu Item label
        $this->page_title = __('Paywall Settings', 'nodeless-paywall');
        $this->menu_title = __('Paywall Settings', 'nodeless-paywall');
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
         * Fields for section: Pricing
         */
         /*
        $fields[] = array(
            'tab'     => 'paywall',
            'field'   => array(
                'name'        => 'paywall_text',
                'label'       => __( 'Text', 'nodeless-paywall' ),
                'description' => __( 'Paywall text (use %s for the amount)', 'nodeless-paywall'),
            ),
        );
        */

        $fields[] = array(
            'tab'     => 'paywall',
            'field'   => array(
                'name'  => 'button_text',
                'label' => __('Button label', 'nodeless-paywall'),
                'description' => __('You can use %{formatted_amount}, %{length}, %{currency}, %{amount}', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'paywall',
            'field'   => array(
                'name'  => 'description',
                'label' => __('Description', 'nodeless-paywall'),
                'description' => __('You can use %{formatted_amount}, %{length}, %{currency}, %{amount}', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'paywall',
            'field'   => array(
                'type'        => 'number',
                'name'        => 'amount',
                'label'       => __('Default amount', 'nodeless-paywall'),
                'description' => __('Amount in smallest unit (e.g. cents/sats) per article', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'paywall',
            'field'   => array(
                'name'        => 'currency',
                'label'       => __('Currency', 'nodeless-paywall'),
                'description' => __('EUR, USD, GBP (default is BTC (sats))', 'nodeless-paywall'),
            ),
        );


        /**
         * Fields for section: Pricing
         */
        $fields[] = array(
            'tab'     => 'advanced',
            'field'   => array(
                'type'        => 'number',
                'name'        => 'timeout',
                'label'       => __('Timeout', 'nodeless-paywall'),
                'description' => __('Disable the paywall X hours after the article is published.', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'advanced',
            'field'   => array(
                'type'        => 'number',
                'name'        => 'timein',
                'label'       => __('Timein', 'nodeless-paywall'),
                'description' => __('Enable the paywall X hours after the article is published.', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'advanced',
            'field'   => array(
                'type'        => 'number',
                'name'        => 'total',
                'label'       => __('Total', 'nodeless-paywall'),
                'description' => __('Total amount to collect. After that amount is reached, the paywall will be disabled.', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'advanced',
            'field'   => array(
                'type'        => 'checkbox',
                'name'        => 'disable_in_rss',
                'value'       => 'on',
                'label'       => __('Disable paywall in RSS', 'nodeless-paywall'),
                'description' => __('Disable paywall in RSS items / show full content in RSS.', 'nodeless-paywall'),
            ),
        );


        /*
        $fields[] = array(
            'tab'     => 'integrations',
            'field'   => array(
                'name'        => 'paywall_lnurl_rss',
                'label'       => __( 'Add LNURL to RSS items', 'nodeless-paywall' ),
                'description' => __( 'Add lightning payment details to RSS items', 'nodeless-paywall'),
            ),
        );
        */


        // Save Form fields to class
        $this->form_fields = $fields;
    }
}
