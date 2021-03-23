<?php

declare(strict_types=1);

namespace Pin\WebhookEndpoint;

use Pin\Request\Delete as DeleteRequest;

/**
 * Deletes a webhook endpoint and all of its webhook requests.
 *
 * @link https://pinpayments.com/developers/api-reference/webhook-endpoints#delete-webhook_endpoints
 *
 * @package Pin\WebhookEndpoint
 */
class Delete extends DeleteRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/webhook_endpoints/__TOKEN__';

    /**
     * The unique token of the webhook endpoint to update.
     *
     * @var string
     */
    protected $token;

    /**
     * Delete Pin webhook endpoint class constructor.
     *
     * @param string $token
     *   A Pin webhook endpoint token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        parent::__construct();
    }
}
