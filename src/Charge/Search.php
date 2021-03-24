<?php

declare(strict_types=1);

namespace Pin\Charge;

use Pin\Request\Get as GetRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Returns a paginated list of charges matching the search criteria.
 *
 * @link https://pinpayments.com/developers/api-reference/charges#search-charges
 *
 * @package Pin\Charge
 */
class Search extends GetRequest
{
    /**
     * Pin API endpoint path for this resource.
     *
     * @var string
     */
    public const URI = '/charges/search';

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined([
                'query',
                'start_date',
                'end_date',
                'sort',
                'direction',
                'per_page',
                'page',
            ])
            ->setAllowedTypes('query', 'string')
            ->setAllowedTypes('start_date', 'string')
            ->setAllowedTypes('end_date', 'string')
            ->setAllowedTypes('sort', 'string')
            ->setAllowedTypes('direction', 'numeric')
            ->setAllowedTypes('per_page', 'numeric')
            ->setAllowedTypes('page', 'numeric');
    }
}
