<?php

declare(strict_types=1);

namespace Pin\Subscription;

use Pin\Request\Get as GetRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Fetch the ledger entries relating to a subscription identified by its token.
 *
 * @link https://pinpayments.com/developers/api-reference/subscriptions#ledger-subscription
 *
 * @package Pin\Subscription
 */
class Ledger extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/subscriptions/__TOKEN__/ledger';

    /**
     * The unique token of the subscription.
     *
     * @var string
     */
    protected $token;

    /**
     * Pin subscription ledger class constructor.
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
            ->setDefined([
                'page',
            ])
            ->setAllowedTypes('page', 'numeric');
    }
}
