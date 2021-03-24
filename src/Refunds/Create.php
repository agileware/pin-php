<?php

declare(strict_types=1);

namespace Pin\Refunds;

use Pin\Request\Post as PostRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Creates a new refund for the specified charge and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/refunds#post-token-refunds
 *
 * @package Pin\Refunds
 */
class Create extends PostRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/charges/__TOKEN__/refunds';

    /**
     * Refund card class constructor.
     *
     * @param $token
     *   The card token.
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
            ->setDefined(['amount'])
            ->setAllowedTypes('amount', 'numeric');
    }
}
