<?php

declare(strict_types=1);

namespace Pin\Customer;

use Pin\Request\Post as PostRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Creates a new customer and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/customers#post-customers
 *
 * @package Pin\Customer
 */
class Create extends PostRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/customers';

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired([
                'email',
            ])
            ->setDefined([
                'ip_address',
                'card',
                'card_token',
            ])
            ->setAllowedTypes('email', 'string')
            ->setAllowedTypes('card', 'array')
            ->setAllowedTypes('card_token', 'string');
    }
}
