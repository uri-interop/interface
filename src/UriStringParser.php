<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

/**
 * [_UriStringParser_][] affords creating a new [_UriStruct_][] instance
 * from a URI string.
 *
 * - Directives:
 *
 *     - Implementations SHOULD use the [RFC 3986 parsing algorithm][].
 *
 * - Notes:
 *
 *     - **The parser returns a new [_UriStruct_][] instance instead of an
 *       array of component values.** This reduces the number of steps
 *       involved in creating a new instance.
 *
 *     - **The native [`parse_url()`][] PHP function is not strictly
 *       [RFC 3986][] compliant.** Using [`parse_url()`][] may be fine for
 *       many cases, but implementations should consider using the
 *       [RFC 3986][]-compliant approach instead.
 */
interface UriStringParser
{
    /**
     * Returns a new [_UriStruct_][] instance parsed from the given URI
     * string.
     */
    public function parseUri(string|Stringable $uriString) : UriStruct;
}
