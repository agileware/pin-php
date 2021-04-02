<?php

declare(strict_types=1);

namespace Pin\Plan;

use Pin\Configuration;
use Pin\Request\Post as PostRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Creates a new plan and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/plans#post-plans
 *
 * @package Pin\Plan
 */
class Create extends PostRequest
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
            ->setRequired([
                'name',
                'amount',
                'currency',
                'interval',
                'interval_unit',
            ])
            ->setDefined([
                'intervals',
                'setup_amount',
                'trial_amount',
                'trial_interval',
                'trial_interval_unit',
                'customer_permissions',
            ])
            ->setAllowedTypes('name', 'string')
            ->setAllowedTypes('amount', 'numeric')
            ->setAllowedTypes('currency', 'string')
            ->setAllowedTypes('interval', 'numeric')
            ->setAllowedTypes('interval_unit', 'string')
            ->setAllowedTypes('intervals', 'numeric')
            ->setAllowedTypes('setup_amount', 'numeric')
            ->setAllowedTypes('trial_amount', 'numeric')
            ->setAllowedTypes('trial_interval', 'numeric')
            ->setAllowedTypes('trial_interval_unit', 'string')
            ->setAllowedTypes('customer_permissions', 'array')
            ->setAllowedValues('currency', Configuration::supportedCurrencies());
    }
}
