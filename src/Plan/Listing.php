<?php

declare(strict_types=1);

namespace Pin\Plan;

use Pin\Request\Get as GetRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Returns a paginated list of all plans.
 *
 * @link https://pinpayments.com/developers/api-reference/plans#get-plans
 *
 * @package Pin\Plan
 */
class Listing extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/plans';

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
