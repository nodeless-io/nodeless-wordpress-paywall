<?php

// If this file is called directly, abort.
defined('WPINC') || die;

/**
 * Lightning Client Interface.
 *
 * Defines the interfaces that are shared by the different client types
 *
 * @since      1.0.0
 * @package    Nodeless_Paywall
 * @subpackage Nodeless_Paywall/includes/clients
 */
interface Nodeless_Paywall_Client_Interface
{
    public function addInvoice($params);
    public function getInvoice($params);
    public function isInvoicePaid();
    public function isConnectionValid();
    public function getInfo();
    public function getAddress();
    public function setAddress();
    public function request();
    public function client();
}
