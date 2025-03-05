<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * Implementations MUST keep `$queryParams` and `$query` in sync; if one is
 * modified, the other MUST be modified accordingly.
 *
 * @phpstan-import-type composed_string from UriTypeAliases
 * @phpstan-import-type decoded_string from UriTypeAliases
 * @phpstan-import-type path_segments_array from UriTypeAliases
 * @phpstan-import-type query_params_array from UriTypeAliases
 */
interface ImmutableUri extends Uri
{
    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$scheme`
     * value.
     */
    public function withScheme(?string $scheme) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$user`
     * value.
     *
     * @param ?decoded_string $user
     */
    public function withUser(?string $user) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$password` value.
     *
     * @param ?decoded_string $password
     */
    public function withPassword(?string $password) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$host`
     * value.
     *
     * @param ?decoded_string $host
     */
    public function withHost(?string $host) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$port`
     * value.
     */
    public function withPort(?int $port) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$path`
     * value.
     *
     * Implementations MUST keep `$path` and `$pathSegments` in sync; if one is
     * modified, the other MUST be modified accordingly.
     *
     * @param ?composed_string $path
     */
    public function withPath(?string $path) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$query`
     * value.
     *
     * Implementations MUST keep `$query` and `$queryParams` in sync; if one is
     * modified, the other MUST be modified accordingly.
     *
     * @param ?composed_string $query
     */
    public function withQuery(?string $query) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$fragment` value.
     *
     * @param ?decoded_string $fragment
     */
    public function withFragment(?string $fragment) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$pathSegments` value.
     *
     * Implementations MUST keep `$path` and `$pathSegments` in sync; if one is
     * modified, the other MUST be modified accordingly.
     *
     * @param ?path_segments_array $pathSegments
     */
    public function withPathSegments(?array $pathSegments) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$queryParams` value.
     *
     * Implementations MUST keep `$query` and `$queryParams` in sync; if one is
     * modified, the other MUST be modified accordingly.
     *
     * @param ?query_params_array $queryParams
     */
    public function withQueryParams(?array $queryParams) : ImmutableUri;
}
