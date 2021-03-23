<?php

declare(strict_types=1);

namespace Pin\Request;

use Pin\Request\Base as BaseRequest;

/**
 * OPTIONS request base class.
 *
 * @package Pin/Request
 */
abstract class Options extends BaseRequest
{
    /**
     * The HTTP method.
     *
     * @var string.
     */
    public const METHOD = 'OPTIONS';
}
