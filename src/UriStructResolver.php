<?php
declare(strict_types=1);

namespace UriInterop\Interface;

interface UriStructResolver
{
    /**
     * Implementations MUST apply the algorithm desribed in RFC 3986 Relative
     * Resolution.
     *
     * Implementations MUST return a new instance of UriStruct.
     *
     * Implementations MAY normalize component values in the returned instance
     * (e.g. by applying syntax-based normalization, scheme-based normalization,
     * protocol-based normalization, etc.).
     */
    public function resolveUri(
        UriStruct $base,
        UriStruct $relative,
    ) : UriStruct;
}
