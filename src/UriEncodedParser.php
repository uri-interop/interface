<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

interface UriEncodedParser extends UriEncoded
{
    public function parseUri(
        string|Stringable $uriString
    ) : UriEncoded&StringableComponents;
}
