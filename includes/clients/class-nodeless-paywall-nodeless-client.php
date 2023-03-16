<?php

// If this file is called directly, abort.
defined('WPINC') || die;

/**
 * Nodeless.io Client.
 *
 * @since      1.0.0
 * @package    Nodeless_Paywall
 * @subpackage Nodeless_Paywall/includes/client
 */
class Nodeless_Paywall_Nodeless_Client extends Abstract_Nodeless_Paywall_Client
{
    const API_URL = [
        'testnet' => 'https://testnet.nodeless.io',
        'production' => 'https://nodeless.io'
    ];

    public string $mode;
    public string $apiUrl;
    public string $apiKey;

    public function __construct($options)
    {
        parent::__construct($options);

        $this->mode = ($this->options['nodeless_mode'] === 'testnet') ? 'testnet' : 'production';
        $this->apiUrl = defined('NODELESS_HOST') ? NODELESS_HOST : self::API_URL[$this->mode];
        $this->apiKey = $this->options['nodeless_apikey'];

        try {
            $this->client = new \NodelessIO\Client\PaywallRequestClient($this->apiUrl, $this->apiKey);
        } catch (\Exception $e) {
            echo "Failed to connect to Nodeless.io: " . $e->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function addInvoice($params)
    {
        // Get the paywall id from the post.
        $paywallId = $this->getPaywallIdFromPost($params['post_id']);

        if (empty($paywallId)) {
            throw new \Exception('No paywall id found for post id: ' . $params['post_id']);
        }

        try {
            $pwRequest = $this->client->createPaywallRequest(
              $paywallId
            );

            if (!empty($pwRequest)) {
                // Mimic getAlby data structure.
                return [
                  'id' => $pwRequest->getId(),
                  'r_hash' => $pwRequest->getId(),
                  'payment_request' => $pwRequest->getLightningInvoice()
                ];
            }
        } catch (\Throwable $e) {
            //todo log "Failed to create paywall invoice: " . $e->getMessage();
            //wp_send_json_error(411);
        }
    }

    /**
     * @inheritDoc
     */
    public function getInvoice($params)
    {
        // Load paywall id and request id.
        $paywallId = $this->getPaywallIdFromPost($params['post_id']);
        $requestId = $params['invoice_id'];

        try {
            // We only use the status endpoint to get payment status as fast as possible.
            // Keeping the general structure and not introducing a separate getInvoiceStatus() for now.
            $status = $this->client->getPaywallRequestStatus($paywallId, $requestId);

            return [
              'id' => $paywallId,
              'r_hash' => $paywallId,
              //'payment_request' => '', // other clients pass ln invoice here but it is only used for status updates anyway it seems
              'settled' => ($status === 'paid') //kinda mimic lnd
            ];
        } catch (\Throwable $e) {
            //wp_send_json_error(411);
        }
    }

    /**
     * @inheritDoc
     */
    public function isInvoicePaid()
    {
        //return $this->client->isInvoicePaid();
    }

    /**
     * @inheritDoc
     */
    public function isConnectionValid()
    {
        // Todo: replace with ping/info endpoint as soon as available.
        $client = new \NodelessIO\Client\StoreClient($this->apiUrl, $this->apiKey);
        $stores = $client->allStores();
        return !empty($stores);
    }

    /**
     * @inheritDoc
     */
    public function getInfo()
    {
        // Todo return info about user/api key connection.
        return [
          'alias' => 'Nodeless.io',
          'identity_pubkey' => '',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getAddress()
    {
        return $this->client->getAddress();
    }

    /**
     * @inheritDoc
     */
    public function setAddress()
    {
        return $this->client->setAddress();
    }

    /**
     * @inheritDoc
     */
    public function request()
    {
        return $this->client->request();
    }

    /**
     * @inheritDoc
     */
    public function client()
    {
        return $this->client;
    }

    public function getPaywallIdFromPost($postId): string
    {
        return get_post_meta($postId, NODELESSIO_PW_POST_META_PAYWALL_ID, true);
    }

    public function getPaywallClient(): \NodelessIO\Client\PaywallClient
    {
        return new \NodelessIO\Client\PaywallClient($this->apiUrl, $this->apiKey);
    }

    public function getPaywallById($paywall_id): ?\NodelessIO\Response\PaywallResponse
    {
        $client = $this->getPaywallClient();
        return $client->getPaywall($paywall_id);
    }

    public function updatePaywall($paywall_id, $name, $price): ?\NodelessIO\Response\PaywallResponse
    {
        $client = $this->getPaywallClient();
        $paywall = $client->updatePaywall(
          $paywall_id,
          $name,
          'wp_article',
          $price,
          []
        );

        return $paywall;
    }

    public function createPaywall($name, $price): \NodelessIO\Response\PaywallResponse
    {
        $client = $this->getPaywallClient();
        $paywall = $client->createPaywall(
          $name,
          'wp_article',
          $price,
          []
        );

        return $paywall;
    }
}
