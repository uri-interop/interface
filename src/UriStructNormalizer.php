<?php
declare(strict_types=1);

namespace UriInterop\Interface;

interface UriStructNormalizer
{
    public function normalizeUri(UriStruct $uri) : UriStruct;
}
