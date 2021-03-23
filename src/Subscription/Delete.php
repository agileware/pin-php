<?php

declare(strict_types=1);

namespace Pin\Subscription;

use Pin\Request\Delete as DeleteRequest;

/**
 * Cancels the subscription identified by subscription token.
 *
 * @link https://pinpayments.com/developers/api-reference/subscriptions#delete-subscription
 *
 * @package Pin\Subscription
 */
class Delete extends DeleteRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/subscriptions/__TOKEN__';

    /**
     * The unique token of the subscription to cancel.
     *
     * @var string
     */
    protected $token;

    /**
     * Delete Pin subscription class constructor.
     *
     * @param string $token
     *   A Pin subscription token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        parent::__construct();
    }
}
