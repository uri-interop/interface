<?php
declare(strict_types=1);

namespace UriInterop\Interface;

interface UriStructNormalizer
{
    /**
     * Implementations MUST apply syntax-based normalization and MAY apply one
     * or more additional normalizations (e.g. scheme-based normalization or
     * protocol-based normalization).
     *
     * Implementations MUST return a new instance of UriStruct.
     */
    public function normalizeUri(UriStruct $uri) : UriStruct;
}
