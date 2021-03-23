<?php

declare(strict_types=1);

namespace Pin\Charge;

use Pin\Configuration;
use Pin\Request\Post as PostRequest;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Creates a new charge and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/charges#post-charges
 *
 * @package Pin\Charge
 */
class Create extends PostRequest
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
            ->setRequired([
                'amount',
                'description',
                'email',
                'ip_address',
            ])
            ->setDefined([
                'card',
                'card_token',
                'customer_token',
                'currency',
                'metadata',
                'capture',
            ])
            ->setAllowedTypes('currency', 'string')
            ->setAllowedTypes('amount', 'numeric')
            ->setAllowedTypes('description', 'string')
            ->setAllowedTypes('email', 'string')
            ->setAllowedTypes('card', 'array')
            ->setAllowedTypes('card_token', 'string')
            ->setAllowedTypes('customer_token', 'string')
            ->setAllowedTypes('capture', 'boolean')
            ->setAllowedTypes('metadata', 'array')
            ->setAllowedValues('currency', Configuration::supportedCurrencies());
    }

    /**
     * {@inheritdoc}
     */
    public function validateOptions()
    {
        // Checks that one of the required options with card information exists.
        if (
            empty($this->options['card']) &&
            empty($this->options['card_token']) &&
            empty($this->options['customer_token'])
        ) {
            throw new MissingOptionsException('Must provide one of the following options: card (array), card_token or customer_token.');
        }
    }
}
