<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

/**
 * @phpstan-type ParsedUrlArray array{
 *     scheme?: string,
 *     port?: int<0, 65535>,
 *     user?: string,
 *     pass?: string,
 *     path?: string,
 *     query?: string,
 *     fragment?: string
 * }
 */
interface UriFactory
{
    /**
     * @param null|string|ParsedUrlArray|Uri $spec
     */
    public function newUri(null|string|Stringable|array|Uri $spec = null) : Uri;
}
