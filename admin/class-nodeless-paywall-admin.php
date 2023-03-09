<?php

 use \tkijewski\lnurl;

// If this file is called directly, abort.
 defined('WPINC') || die;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nodeless_Paywall
 * @subpackage Nodeless_Paywall/admin
 */
class Nodeless_Paywall_Admin
{

    /**
     * Main Plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    Nodeless_Paywall    $plugin    The main plugin object.
     */
    private $plugin;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param Nodeless_Paywall $plugin The main plugin object.
     */
    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style($this->plugin->get_plugin_name(), plugin_dir_url(__FILE__) . 'css/nodeless-paywall-admin.css', array(), $this->plugin->get_version(), 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script($this->plugin->get_plugin_name(), plugin_dir_url(__FILE__) . 'js/nodeless-paywall-admin.js', array( 'jquery' ), $this->plugin->get_version(), true);
    }

    /**
     * Admin Page
     */
    public function lightning_menu()
    {
        add_menu_page(
            'Nodeless Paywall',
            'NL Paywall',
            'manage_options',
            'nlpw_settings',
            null,
            'dashicons-superhero'
        );
    }


    /**
     * Add Gutenberg Blocks
     *
     */
    public function init_gutenberg_blocks()
    {

        // Gutenberg is not active.
        if (! function_exists('register_block_type') ) {
            return;
        }

        //register_block_type(dirname(__DIR__, 1) . '/blocks/donate/block.json');
        register_block_type(
            dirname(__DIR__, 1) . '/blocks/paywall/block.json',
            array(
                'render_callback' => [$this, 'render_paywall_shortcode'],
            )
        );

    }

    function render_paywall_shortcode( $attributes, $content )
    {
        $sanitized_attributes = array_map(
            function ($key, $value) {
                return strval($key) . '="' . esc_html(strval($value)) . '"';
            }, array_keys($attributes), array_values($attributes)
        );
        $shortcode_attributes = implode(" ", $sanitized_attributes);
        return "[nlpaywall " . $shortcode_attributes . " ]";
    }

}
