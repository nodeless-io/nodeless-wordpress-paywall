<?php

// If this file is called directly, abort.
defined('WPINC') || die;

class NLPW_GeneralPage extends NLPW_SettingsPage
{
    protected $settings_path = 'nlpw_settings_general';
    protected $template_html = 'settings/page-general.php';
    protected $option_name   = 'nlpw_general';

    public function init_fields()
    {
        // Tabs
        $this->tabs   = array(
          /* disabled for now
            'value4value' => array(
                'title' => __('Value 4 Value', 'nodeless-paywall'),
            ), */
            'general' => array(
                'title' => __('General', 'nodeless-paywall'),
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
        $this->page_title = __('General Settings', 'nodeless-paywall');
        $this->menu_title = __('General Settings', 'nodeless-paywall');
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
        /* v4v disabled for now, needs integration with nodeless */
        /*
        $fields[] = array(
            'tab'     => 'value4value',
            'field'   => array(
                'type'  => 'checkbox',
                'name'  => 'lnurl_meta_tag',
                'value' => 'on',
                'label' => __('Enable Value 4 Value Lightning meta tag', 'nodeless-paywall'),
                'description' => __('Enable the Lightning metatag which allows visitors to send sats to your page', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'value4value',
            'field'   => array(
                'name'  => 'lnurl_meta_tag_lnurlp',
                'label' => __('Custom recipient for the Lightning meta tag', 'nodeless-paywall'),
                'description' => __('By default the connected wallet is used to generate the meta tag. You can overwrite this here for example with your Lightning Address.', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'value4value',
            'field'   => array(
                'type'  => 'checkbox',
                'name'  => 'add_v4v_rss_tag',
                'value' => 'on',
                'label' => __('Enable Value 4 Value tag', 'nodeless-paywall'),
                'description' => __('Add the podcast:value tag to your RSS feed. Configure the node address (and custom key/value if needed).', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'value4value',
            'field'   => array(
                'name'  => 'v4v_node_key',
                'label' => __('Node Address', 'nodeless-paywall'),
                'description' => __('Node address - the Lightning node public key', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'value4value',
            'field'   => array(
                'name'  => 'v4v_custom_key',
                'label' => __('Custom Key', 'nodeless-paywall'),
            ),
        );
        $fields[] = array(
            'tab'     => 'value4value',
            'field'   => array(
                'name'  => 'v4v_custom_value',
                'label' => __('Custom Value', 'nodeless-paywall'),
            ),
        );
        $fields[] = array(
            'tab'     => 'value4value',
            'field'   => array(
                'type'  => 'checkbox',
                'name'  => 'disable_add_v4v_rss_ns_tag',
                'value' => 'on',
                'label' => __('Disable podcast namespace injection', 'nodeless-paywall'),
                'description' => __('Do not auto-inject the podcast namespace. Some other plugins (like Seriously Simple Podcasting) might do this already which then might causes errors.', 'nodeless-paywall'),
            ),
        );
        */

        $fields[] = array(
            'tab'     => 'general',
            'field'   => array(
                'name'  => 'cookie_timeframe_days',
                'label' => __('Cookie timeframe', 'nodeless-paywall'),
                'description' => __('Paid articles are saved in a cookie. How many days should these cookies be valid? (default: 180)', 'nodeless-paywall'),
            ),
        );

        // Save Form fields to class
        $this->form_fields = $fields;
    }
}
