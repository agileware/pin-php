<?php

declare(strict_types=1);

namespace Pin\Charge;

use Pin\Request\Put as PutRequest;

/**
 * Captures a previously authorised charge and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/charges#capture-charges
 *
 * @package Pin\Charge
 */
class Capture extends PutRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/charges/__TOKEN__/capture';

    /**
     * Capture charge class constructor.
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
