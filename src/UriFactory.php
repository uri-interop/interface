<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * @phpstan-import-type composed_string from UriTypeAliases
 * @phpstan-import-type decoded_string from UriTypeAliases
 */
interface UriFactory
{
    /**
     * @param ?decoded_string $user
     * @param ?decoded_string $password
     * @param ?decoded_string $host
     * @param composed_string $path
     * @param ?composed_string $query
     * @param ?decoded_string $fragment
     */
    public function newUri(
        ?string $scheme = null,
        ?string $user = null,
        ?string $password = null,
        ?string $host = null,
        ?int $port = null,
        string $path = '',
        ?string $query = null,
        ?string $fragment = null,
    ) : Uri;
}
