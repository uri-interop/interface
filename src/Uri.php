<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

/**
 * Implementations MAY sanitize component values (e.g. by applying `trim()`.
 *
 * Implementations MAY validate component values; the implementation MUST throw
 * _LogicException_ (or an extension thereof) when the component value is
 * invalid.
 *
 * @phpstan-import-type uri_composed_string from UriTypeAliases
 * @phpstan-import-type uri_decoded_string from UriTypeAliases
 * @phpstan-import-type uri_encoded_string from UriTypeAliases
 * @phpstan-import-type uri_query_params_array from UriTypeAliases
 */
interface Uri extends Stringable
{
    /**
     * The scheme (e.g., `https` or `urn`); does not include the `:` separator.
     */
    public string $scheme { get; }

    /**
     * The user name.
     *
     * @var uri_decoded_string
     */
    public string $user { get; }

    /**
     * The password.
     */
    public string $password { get; }

    /**
     * The hostname or IP address (e.g. `www.example.net`, `127.0.0.1`, `::1`, and so on).
     *
     * @var uri_decoded_string
     */
    public string $host { get; }

    /**
     * The port (e.g. `443`).
     */
    public ?int $port { get; }

    /**
     * The path (e.g. `/path/to/page.html`, `ietf:rfc:3986`, `user@example.net`, and so on).
     *
     * @var uri_encoded_string
     */
    public string $path { get; }

    /**
     * The query string (e.g. `foo=bar&baz=qux`); does not include the `?` separator.
     *
     * @var uri_encoded_string
     */
    public string $query { get; }

    /**
     * The fragment; does not include the `#` separator.
     */
    public string $fragment { get; }

    /**
     *  A form of `$query` as an array.
     *
     * @var uri_query_params_array
     */
    public array $queryParams { get; }

    /**
     * The composed `$user` and `$password` (e.g. as per RFC 3986).
     *
     * @var uri_composed_string
     */
    public string $userInfo { get; }

    /**
     * The composed `$userInfo`, `$host`, and `$port` (e.g. as per RFC 3986).
     *
     * @var uri_composed_string
     */
    public string $authority  { get; }

    /**
     * Composes the component values into a full URI string.
     *
     * @return uri_composed_string
     */
    public function __toString() : string;
}
