<?php

declare(strict_types=1);

namespace Pin\Charge;

use Pin\Request\Get as GetRequest;

/**
 * Returns the details of a charge.
 *
 * @link https://pinpayments.com/developers/api-reference/charges#get-charge
 *
 * @package Pin\Charge
 */
class Details extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/charges/__TOKEN__';

    /**
     * The charge token.
     *
     * @var string
     */
    protected $token;

    /**
     * Charge details class constructor.
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
