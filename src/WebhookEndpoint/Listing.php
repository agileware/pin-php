<?php

declare(strict_types=1);

namespace Pin\WebhookEndpoint;

use Pin\Request\Get as GetRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Returns a paginated list of all webhook endpoints.
 *
 * @link https://pinpayments.com/developers/api-reference/webhook-endpoints#get-webhook_endpoints
 *
 * @package Pin\WebhookEndpoint
 */
class Listing extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/webhook_endpoints';

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
