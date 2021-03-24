<?php

declare(strict_types=1);

namespace Pin\Plan;

use Pin\Request\Get as GetRequest;

/**
 * Returns the details of a specified plan.
 *
 * @link https://pinpayments.com/developers/api-reference/plans#get-plan
 *
 * @package Pin\Plan
 */
class Details extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/plans/__TOKEN__';

    /**
     * Plan details class constructor.
     *
     * @param string $token
     *   The plan token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        parent::__construct();
    }
}
