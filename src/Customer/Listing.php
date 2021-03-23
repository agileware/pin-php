<?php

declare(strict_types=1);

namespace Pin\Customer;

use Pin\Request\Get as GetRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Returns a paginated list of all customers.
 *
 * @link https://pinpayments.com/developers/api-reference/customers#get-customers
 *
 * @package Pin\Customer
 */
class Listing extends GetRequest
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
            ->setDefined([
                'per_page',
                'page',
            ])
            ->setAllowedTypes('per_page', 'numeric')
            ->setAllowedTypes('page', 'numeric');
    }
}
