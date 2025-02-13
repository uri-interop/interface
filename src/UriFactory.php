<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

interface UriFactory
{
    public function newUri(
        string $scheme = '',
        string $user = '',
        string $password = '',
        string $host = '',
        ?int $port = null,
        string $path = '',
        string $query = '',
        string $fragment = '',
    ) : Uri;
}
