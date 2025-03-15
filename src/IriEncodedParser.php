<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

interface IriEncodedParser extends IriEncoded
{
    public function parseIri(
        string|Stringable $iriString
    ) : IriEncoded&StringableComponents;
}
