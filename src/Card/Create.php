<?php

declare(strict_types=1);

namespace Pin\Card;

use Pin\Request\Post as PostRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Stores a card’s details and returns its token and other information.
 *
 * @link https://pinpayments.com/developers/api-reference/cards
 *
 * @package Pin\Card
 */
class Create extends PostRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/cards';

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired([
                'number',
                'expiry_month',
                'expiry_year',
                'cvc',
                'name',
                'address_line1',
                'address_city',
                'address_postcode',
                'address_state',
                'address_country',
            ])
            ->setDefined([
                'address_line2',
             ])
            ->setAllowedTypes('number', 'numeric')
            ->setAllowedTypes('expiry_month', 'numeric')
            ->setAllowedTypes('expiry_year', 'numeric')
            ->setAllowedTypes('cvc', 'numeric')
            ->setAllowedTypes('name', 'string')
            ->setAllowedTypes('address_line1', 'string')
            ->setAllowedTypes('address_line2', 'string')
            ->setAllowedTypes('address_city', 'string')
            ->setAllowedTypes('address_postcode', 'numeric')
            ->setAllowedTypes('address_state', 'string')
            ->setAllowedTypes('address_country', 'string');
    }
}
