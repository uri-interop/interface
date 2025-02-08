<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * @phpstan-import-type QueryParamsArray from Uri
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
     */
    public function withUser(string $user) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$password` value.
     */
    public function withPassword(string $password) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$host`
     * value.
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
     */
    public function withPath(string $path) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified `$query`
     * value.
     */
    public function withQuery(string $query) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$fragment` value.
     */
    public function withFragment(string $fragment) : ImmutableUri;

    /**
     * Returns a new instance of the _ImmutableUri_ with the modified
     * `$queryParams` value.
     *
     * @param QueryParamsArray $queryParams
     */
    public function withQueryParams(array $queryParams) : ImmutableUri;
}
