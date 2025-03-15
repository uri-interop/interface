<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * @phpstan-import-type composed_string from UriTypeAliases
 * @phpstan-import-type percent_composed_string from UriTypeAliases
 * @phpstan-import-type percent_encoded_string from UriTypeAliases
 */
interface UriEncodedFactory extends UriEncoded
{
    /**
     * @param ?percent_encoded_string $user
     * @param ?percent_encoded_string $password
     * @param ?percent_encoded_string $host
     * @param percent_composed_string $path
     * @param ?composed_string $query
     * @param ?percent_composed_string $fragment
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
    ) : UriEncoded&StringableComponents;
}
