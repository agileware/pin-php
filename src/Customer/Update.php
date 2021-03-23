<?php

declare(strict_types=1);

namespace Pin\Customer;

use Pin\Request\Put as PutRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Updates the details of a customer and returns the updated details.
 *
 * @link https://pinpayments.com/developers/api-reference/customers#put-customer
 *
 * @package Pin\Customer
 */
class Update extends PutRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/customers/__TOKEN__';

    /**
     * The unique token of the customer to update.
     *
     * @var string
     */
    protected $token;

    /**
     * Update Pin customer class constructor.
     *
     * @param string $token
     *   A Pin customer token.
     * @param array $options
     *   Request options.
     */
    public function __construct(string $token, array $options = [])
    {
        $this->token = $token;
        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined([
                'email',
                'card',
                'card_token',
                'primary_card_token',
            ])
            ->setAllowedTypes('email', 'string')
            ->setAllowedTypes('card', 'object')
            ->setAllowedTypes('card_token', 'string')
            ->setAllowedTypes('primary_card_token', 'string');
    }
}
