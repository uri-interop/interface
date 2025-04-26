<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * @phpstan-import-type composed_string from UriTypeAliases
 * @phpstan-import-type percent_composed_string from UriTypeAliases
 * @phpstan-import-type percent_encoded_string from UriTypeAliases
 * @phpstan-import-type query_params_array from UriTypeAliases
 */
interface ImmutableUriStruct extends UriStruct
{
    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$scheme`
     * value.
     */
    public function withScheme(?string $scheme) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$username`
     * value.
     *
     * @param ?percent_encoded_string $username
     */
    public function withUsername(?string $username) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$password` value.
     *
     * @param ?percent_encoded_string $password
     */
    public function withPassword(?string $password) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$host`
     * value.
     *
     * @param ?percent_encoded_string $host
     */
    public function withHost(?string $host) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$port`
     * value.
     */
    public function withPort(?int $port) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$path`
     * value.
     *
     * @param percent_composed_string $path
     */
    public function withPath(string $path) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$query`
     * value.
     *
     * Implementations MUST keep `$query` and `$queryParams` in sync; if one is
     * modified, the other MUST be modified accordingly.
     *
     * @param ?composed_string $query
     */
    public function withQuery(?string $query) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$fragment` value.
     *
     * @param ?percent_composed_string $fragment
     */
    public function withFragment(?string $fragment) : ImmutableUriStruct;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$queryParams` value.
     *
     * Implementations MUST keep `$query` and `$queryParams` in sync; if one is
     * modified, the other MUST be modified accordingly.
     *
     * @param ?query_params_array $queryParams
     */
    public function withQueryParams(?array $queryParams) : ImmutableUriStruct;
}
