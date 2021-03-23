<?php

declare(strict_types=1);

namespace Pin\WebhookEndpoint;

use Pin\Request\Get as GetRequest;

/**
 * Returns the details of the specified webhook endpoint.
 *
 * @link https://pinpayments.com/developers/api-reference/webhook-endpoints#get-webhook_endpoints-token
 *
 * @package Pin\WebhookEndpoint
 */
class Details extends GetRequest
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
     * Pin webhook endpoint details class constructor.
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
