<?php

declare(strict_types=1);

namespace Pin\Charge;

use Pin\Request\Put as PutRequest;

/**
 * Voids a previously authorised charge and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/charges#void-charges
 *
 * @package Pin\Charge
 */
class VoidCharge extends PutRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/charges/__TOKEN__/void';

    /**
     * Void charge class constructor.
     *
     * @param string $token
     *   The charge token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        parent::__construct();
    }
}
