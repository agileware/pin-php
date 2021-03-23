<?php

declare(strict_types=1);

namespace Pin\Customer;

use Pin\Request\Get as GetRequest;

/**
 * Returns the details of a customer.
 *
 * @link https://pinpayments.com/developers/api-reference/customers#get-customer
 *
 * @package Pin\Customer
 */
class Details extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/customers/__TOKEN__';

    /**
     * The customer token.
     *
     * @var string
     */
    protected $token;

    /**
     * Customer details class constructor.
     *
     * @param string $token
     *   The customer token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        parent::__construct();
    }
}
