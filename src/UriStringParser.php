<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

interface UriStringParser
{
    public function parseUri(string|Stringable $uriString) : UriComponents;
}
