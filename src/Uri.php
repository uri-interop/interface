<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

/**
 * @phpstan-type QueryParamsArray    string[]|QueryParamsArray_00
 * @phpstan-type QueryParamsArray_00 string[]|QueryParamsArray_01
 * @phpstan-type QueryParamsArray_01 string[]|QueryParamsArray_02
 * @phpstan-type QueryParamsArray_02 string[]|QueryParamsArray_03
 * @phpstan-type QueryParamsArray_03 string[]|QueryParamsArray_04
 * @phpstan-type QueryParamsArray_04 string[]|QueryParamsArray_05
 * @phpstan-type QueryParamsArray_05 string[]|QueryParamsArray_06
 * @phpstan-type QueryParamsArray_06 string[]|QueryParamsArray_07
 * @phpstan-type QueryParamsArray_07 string[]|QueryParamsArray_08
 * @phpstan-type QueryParamsArray_08 string[]|QueryParamsArray_09
 * @phpstan-type QueryParamsArray_09 string[]|QueryParamsArray_0A
 * @phpstan-type QueryParamsArray_0A string[]|QueryParamsArray_0B
 * @phpstan-type QueryParamsArray_0B string[]|QueryParamsArray_0C
 * @phpstan-type QueryParamsArray_0C string[]|QueryParamsArray_0D
 * @phpstan-type QueryParamsArray_0D string[]|QueryParamsArray_0E
 * @phpstan-type QueryParamsArray_0E string[]|QueryParamsArray_0F
 * @phpstan-type QueryParamsArray_0F string[]
 */
interface Uri extends Stringable
{
    /**
     * Corresponds to the `scheme` key from `parse_url()`.
     */
    public string $scheme { get; }

    /**
     * Corresponds to the `user` key from `parse_url()`.
     */
    public string $user { get; }

    /**
     * Corresponds to the `pass` key from `parse_url()`.
     */
    public string $password { get; }

    /**
     * Corresponds to the `host` key from `parse_url()`.
     */
    public string $host { get; }

    /**
     * Corresponds to the `port` key from `parse_url()`.
     */
    public ?int $port { get; }

    /**
     * Corresponds to the `path` key from `parse_url()`.
     */
    public string $path { get; }

    /**
     * Corresponds to the `query` key from `parse_url()`.
     *
     * Implementations MUST keep `$query` and `$queryParams` in sync;
     * if one is modified, the other MUST be modified accordingly.
     */
    public string $query { get; }

    /**
     * Corresponds to the `fragment` key from `parse_url()`.
     */
    public string $fragment { get; }

    /**
     * The query string decoded into an array.
     *
     * Implementations MUST keep `$query` and `$queryParams` in sync;
     * if one is modified, the other MUST be modified accordingly.
     *
     * @var QueryParamsArray
     */
    public array $queryParams { get; }

    /**
     * The combined `$user` and `$password` as specified by
     * <https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2.1>.
     */
    public string $userInfo { get; }

    /**
     * The combined `$user`, `$password`, `$host`, and `$port` as specified by
     * <https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2>.
     */
    public string $authority  { get; }

    /**
     * Returns the full URI as a string.
     */
    public function __toString() : string;
}
