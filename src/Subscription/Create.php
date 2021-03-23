<?php

declare(strict_types=1);

namespace Pin\Subscription;

use Pin\Request\Post as PostRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Activate a new subscription and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/subscriptions#post-subscriptions
 *
 * @package Pin\Subscription
 */
class Create extends PostRequest
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
            ->setRequired([
                'plan_token',
                'customer_token',
            ])
            ->setDefined([
                'card_token',
                'include_setup_fee',
            ])
            ->setAllowedTypes('plan_token', 'string')
            ->setAllowedTypes('customer_token', 'string')
            ->setAllowedTypes('card_token', 'string');
    }
}
