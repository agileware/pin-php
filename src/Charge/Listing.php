<?php

declare(strict_types=1);

namespace Pin\Charge;

use Pin\Request\Get as GetRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Returns a paginated list of all charges.
 *
 * @link https://pinpayments.com/developers/api-reference/charges#get-charges
 *
 * @package Pin\Charge
 */
class Listing extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/charges';

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
