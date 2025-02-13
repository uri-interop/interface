<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

interface UriParser
{
    public function parseUri(string|Stringable $uriString) : Uri;
}
