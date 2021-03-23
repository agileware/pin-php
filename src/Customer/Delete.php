<?php

declare(strict_types=1);

namespace Pin\Customer;

use Pin\Request\Delete as DeleteRequest;

/**
 * Deletes a customer and all of its cards. You will not be able to recover
 * them.
 *
 * @link https://pinpayments.com/developers/api-reference/customers#delete-customer
 *
 * @package Pin\Customer
 */
class Delete extends DeleteRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/customers/__TOKEN__';

    /**
     * The unique token of the customer to delete.
     *
     * @var string
     */
    protected $token;

    /**
     * Delete Pin customer class constructor.
     *
     * @param string $token
     *   A Pin customer token.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        parent::__construct();
    }
}
