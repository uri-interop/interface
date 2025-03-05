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
 * @phpstan-import-type composed_string from UriTypeAliases
 * @phpstan-import-type decoded_string from UriTypeAliases
 * @phpstan-import-type path_segments_array from UriTypeAliases
 * @phpstan-import-type query_params_array from UriTypeAliases
 */
interface Uri extends Stringable
{
    /**
     * The scheme (e.g., `https` or `urn`); does not include the `:` separator.
     */
    public ?string $scheme { get; }

    /**
     * The user name.
     *
     * @var ?decoded_string
     */
    public ?string $user { get; }

    /**
     * The password.
     */
    public ?string $password { get; }

    /**
     * The hostname or IP address (e.g. `www.example.net`, `127.0.0.1`, `::1`, and so on).
     *
     * @var ?decoded_string
     */
    public ?string $host { get; }

    /**
     * The port (e.g. `443`).
     */
    public ?int $port { get; }

    /**
     * The path (e.g. `/path/to/page.html`, `ietf:rfc:3986`, `user@example.net`, and so on).
     *
     * @var ?composed_string
     */
    public ?string $path { get; }

    /**
     * The query string (e.g. `foo=bar&baz=qux`); does not include the `?` separator.
     *
     * @var ?composed_string
     */
    public ?string $query { get; }

    /**
     * The fragment; does not include the `#` separator.
     *
     * @var ?decoded_string
     */
    public ?string $fragment { get; }

    /**
     *  A form of `$path` as an array.
     *
     * @var ?path_segments_array
     */
    public ?array $pathSegments { get; }

    /**
     *  A form of `$query` as an array.
     *
     * @var ?query_params_array
     */
    public ?array $queryParams { get; }

    /**
     * The composed `$user` and `$password` (e.g. as per RFC 3986).
     *
     * @var ?composed_string
     */
    public ?string $userInfo { get; }

    /**
     * The composed `$userInfo`, `$host`, and `$port` (e.g. as per RFC 3986).
     *
     * @var ?composed_string
     */
    public ?string $authority  { get; }

    /**
     * Composes the component values into a full URI string.
     *
     * @return composed_string
     */
    public function __toString() : string;
}
