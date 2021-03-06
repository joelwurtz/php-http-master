<?php

namespace Http\Discovery;

use Http\Client\HttpClient;

/**
 * Finds an HTTP Client.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class HttpClientDiscovery extends ClassDiscovery
{
    /**
     * @var HttpClient
     */
    protected static $cache;

    /**
     * @var array
     */
    protected static $classes = [
        'guzzle6' => [
            'class'     => 'Http\Adapters\Guzzle6\Guzzle6HttpAdapter',
            'condition' => 'Http\Adapters\Guzzle6\Guzzle6HttpAdapter',
        ],
        'guzzle5' => [
            'class'     => 'Http\Adapters\Guzzle5HttpAdapter',
            'condition' => 'Http\Adapters\Guzzle5HttpAdapter',
        ],
    ];

    /**
     * Finds an HTTP Client.
     *
     * @return HttpClient
     *
     * @throws NotFoundException
     */
    public static function find()
    {
        // Override only used for return type declaration
        return parent::find();
    }
}
