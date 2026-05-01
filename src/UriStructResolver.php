<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * [_UriStructResolver_][] affords creating a new [_UriStruct_][] instance
 * by resolving a relative URI reference against a base URI.
 */
interface UriStructResolver
{
    /**
     * Returns a new [_UriStruct_][] instance representing `$relative`
     * resolved against `$base`.
     *
     * - Directives:
     *
     *     - Implementations MUST apply the algorithm described in
     *       [RFC 3986 Relative Resolution][].
     *
     *     - Implementations MUST return a new instance of [_UriStruct_][].
     *
     *     - Implementations MAY [normalize component values][] in the
     *       returned instance (e.g. by applying [syntax-based normalization][],
     *       [scheme-based normalization][], [protocol-based normalization][],
     *       etc.).
     */
    public function resolveUri(UriStruct $base, UriStruct $relative) : UriStruct;
}
