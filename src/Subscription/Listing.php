<?php

declare(strict_types=1);

namespace Pin\Subscription;

use Pin\Request\Get as GetRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Returns a paginated list of all subscriptions.
 *
 * @link https://pinpayments.com/developers/api-reference/subscriptions#get-subscriptions
 *
 * @package Pin\Subscription
 */
class Listing extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/subscriptions';

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
