<?php

declare(strict_types=1);

namespace Pin\Subscription;

use Pin\Request\Put as PutRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Pin subcription reactivation class.
 *
 * Reactivates the subscription identified by subscription token, returning the
 * details of the subscription.
 *
 * @link https://pinpayments.com/developers/api-reference/subscriptions#reactivate-subscription
 *
 * @package Pin\Subscription
 */
class Reactivate extends PutRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/subscriptions/__TOKEN__/reactivate';

    /**
     * Pin subscription reactivation class constructor.
     *
     * @param string $token
     *   A subscription token.
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
            ->setRequired([
                'include_setup_fee',
            ])
            ->setAllowedTypes('include_setup_fee', 'boolean');
    }
}
