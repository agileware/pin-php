<?php

declare(strict_types=1);

namespace Pin\WebhookEndpoint;

use Pin\Request\Post as PostRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Creates a new webhook endpoint and returns its details.
 *
 * @link https://pinpayments.com/developers/api-reference/webhook-endpoints#post-webhook_endpoints
 *
 * @package Pin\WebhookEndpoint
 */
class Create extends PostRequest
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
            ->setRequired([
                'url',
            ])
            ->setAllowedTypes('url', 'string');
    }
}
