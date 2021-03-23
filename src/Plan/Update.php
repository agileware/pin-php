<?php

declare(strict_types=1);

namespace Pin\Plan;

use Pin\Request\Put as PutRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Update the specified plan.
 *
 * @link https://pinpayments.com/developers/api-reference/plans#put-plan
 *
 * @package Pin\Plan
 */
class Update extends PutRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/plans/__TOKEN__';

    /**
     * The unique token of the plan to update.
     *
     * @var string
     */
    protected $token;

    /**
     * Update Pin plan constructor.
     *
     * @param string $token
     *   A Pin plan token.
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
                'name',
                'customer_permissions',
            ])
            ->setAllowedTypes('name', 'string')
            ->setAllowedTypes('customer_permissions', 'array');
    }
}
