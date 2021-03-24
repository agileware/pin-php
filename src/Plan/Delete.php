<?php

declare(strict_types=1);

namespace Pin\Plan;

use Pin\Request\Delete as DeleteRequest;

/**
 * Deletes a plan and all of its subscriptions.
 *
 * @link https://pinpayments.com/developers/api-reference/plans#delete-plan
 *
 * @package Pin\Plan
 */
class Delete extends DeleteRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/plans/__TOKEN__';

    /**
     * Delete Pin plan class constructor.
     *
     * @param string $token
     *   A Pin plan token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        parent::__construct();
    }
}
