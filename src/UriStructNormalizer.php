<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * [_UriStructNormalizer_][] affords creating a [_UriStruct_][] instance
 * with [normalized component values][].
 */
interface UriStructNormalizer
{
    /**
     * Returns a new [_UriStruct_][] instance with normalized component
     * values.
     *
     * - Directives:
     *
     *     - Implementations MUST apply [syntax-based normalization][] and MAY
     *       apply one or more additional normalizations (e.g.
     *       [scheme-based normalization][] or
     *       [protocol-based normalization][]).
     *
     *     - Implementations MUST return a new instance of [_UriStruct_][].
     */
    public function normalizeUri(UriStruct $uri) : UriStruct;
}
