<?php
declare(strict_types=1);

namespace UriInterop\Interface;

interface UriStructResolver
{
    public function resolveUri(
        UriStruct $relative,
        UriStruct $base,
    ) : UriStruct;
}
