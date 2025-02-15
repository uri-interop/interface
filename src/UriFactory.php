<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * @phpstan-import-type uri_composed_string from UriTypeAliases
 * @phpstan-import-type uri_decoded_string from UriTypeAliases
 */
interface UriFactory
{
    /**
     * @param uri_decoded_string $user
     * @param uri_decoded_string $password
     * @param uri_decoded_string $host
     * @param uri_composed_string $path
     * @param uri_composed_string $query
     * @param uri_decoded_string $fragment
     */
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
