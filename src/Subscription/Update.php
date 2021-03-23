<?php

declare(strict_types=1);

namespace Pin\Subscription;

use Pin\Request\Put as PutRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Updates the card associated with a subscription identified by its token.
 *
 * @link https://pinpayments.com/developers/api-reference/subscriptions#update-subscription
 *
 * @package Pin\Subscription
 */
class Update extends PutRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/subscriptions/__TOKEN__';

    /**
     * The subscription token.
     *
     * @var null
     */
    protected $token;

    /**
     * Pin subcription update class constructor.
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
                'card_token',
            ])
            ->setAllowedTypes('card_token', ['string', 'null']);
    }
}
