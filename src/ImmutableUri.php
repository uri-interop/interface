<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * Implementations MUST keep `$queryParams` and `$query` in sync; if one is
 * modified, the other MUST be modified accordingly.
 *
 * @phpstan-import-type uri_composed_string from UriTypeAliases
 * @phpstan-import-type uri_decoded_string from UriTypeAliases
 * @phpstan-import-type uri_query_params_array from UriTypeAliases
 */
interface ImmutableUri extends Uri
{
    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$scheme`
     * value.
     */
    public function withScheme(string $scheme) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$user`
     * value.
     *
     * @param uri_decoded_string $user
     */
    public function withUser(string $user) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$password` value.
     *
     * @param uri_decoded_string $password
     */
    public function withPassword(string $password) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$host`
     * value.
     *
     * @param uri_decoded_string $host
     */
    public function withHost(string $host) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$port`
     * value.
     */
    public function withPort(?int $port) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$path`
     * value.
     *
     * @param uri_composed_string $path
     */
    public function withPath(string $path) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$query`
     * value.
     *
     * @param uri_composed_string $query
     */
    public function withQuery(string $query) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$fragment` value.
     *
     * @param uri_decoded_string $fragment
     */
    public function withFragment(string $fragment) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$queryParams` value.
     *
     * @param uri_query_params_array $queryParams
     */
    public function withQueryParams(array $queryParams) : ImmutableUri;
}
