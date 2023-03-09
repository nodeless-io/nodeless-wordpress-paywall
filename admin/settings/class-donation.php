<?php

// If this file is called directly, abort.
defined('WPINC') || die;

class NLPW_DonationPage extends NLPW_SettingsPage
{
    protected $settings_path = 'nlpw_settings_donation';
    protected $option_name   = 'nlpw_donation';
    protected $template_html = 'settings/page-donation.php';

    public function init_fields()
    {
        // Tabs
        $this->tabs   = array(
            'integrations' => array(
                'title' => __('Integrations', 'nodeless-paywall'),
            ),
            'widget' => array(
                'title' => __('Donation Widget', 'nodeless-paywall'),
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
        $this->page_title = __('Donations Settings', 'nodeless-paywall');
        $this->menu_title = __('Donations', 'nodeless-paywall');
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
         * Fields for section: Integrations
         */
        $fields[] = array(
            'tab'     => 'integrations',
            'field'   => array(
                'type'        => 'checkbox_group',
                'name'        => 'donations_enabled_for',
                'options'     => $this->get_post_types(),
                'label'       => __('Auto add donation box', 'nodeless-paywall'),
                'description' => __('Enable this option to automatically append the donation block to the end of each post, for selected post type. You can still manually add the donation box with shortcode or Gutenberg block', 'nodeless-paywall'),
            ),
        );


        /**
         * Values for field: Placement
         * Make it readable
         */
        $options   = array();
        $options[] = array(
            'value' => 'above',
            'label' => __('Above content', 'nodeless-paywall'),
        );

        $options[] = array(
            'value' => 'below',
            'label' => __('Below content', 'nodeless-paywall'),
        );

        $fields[] = array(
            'tab'     => 'integrations',
            'field'   => array(
                'type'        => 'checkbox_group',
                'name'        => 'donations_autoadd',
                'options'     => $options,
                'label'       => __('Placement', 'nodeless-paywall'),
                'description' => __('Where to add the donation box, if not selected the donation box will not be inserted automatically', 'nodeless-paywall'),
            ),
        );


        $fields[] = array(
            'tab'     => 'widget',
            'field'   => array(
                'type'    => 'number',
                'name'    => 'widget_amount',
                'default' => 100000,
                'label'   => __('Default amount in sats', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'widget',
            'field'   => array(
                'type'    => 'text',
                'name'    => 'widget_title',
                'default' => 'Show some love',
                'label'   => __('Widget title', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'widget',
            'field'   => array(
                'type'    => 'text',
                'name'    => 'widget_description',
                'default' => 'Support us by donating sats to keep us going',
                'label'   => __('Widget description', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'widget',
            'field'   => array(
                'type'        => 'text',
                'name'        => 'widget_thankyou',
                'default'     => 'Woow, you are awesome! Thank you for your support!',
                'label'       => __('Thank you message', 'nodeless-paywall'),
                'description' => __('Will be displayed after payment is processed', 'nodeless-paywall'),
            ),
        );

        $fields[] = array(
            'tab'     => 'widget',
            'field'   => array(
                'type'    => 'text',
                'name'    => 'widget_button_label',
                'default' => 'Donate now',
                'label'   => __('Widget button label', 'nodeless-paywall'),
            ),
        );

        // Save Form fields to class
        $this->form_fields = $fields;
    }


    /**
     * Get all registered post types
     * This will populate checbox group where user selects where to
     * automatically prepend or append donation box
     *
     * @return [array] array('post_type' => 'Label');
     */
    private function get_post_types()
    {

        /**
         * Docs:
         *
         * @link https://developer.wordpress.org/reference/functions/get_post_types/
         */
        $types   = get_post_types(array('public' => true), 'objects');
        $options = array();

        foreach ( $types as $type )
        {
            $options[] = array(
                'label' => $type->label,
                'value' => $type->name,
            );
        }

        return $options;
    }
}
