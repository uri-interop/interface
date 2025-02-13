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
 * @phpstan-import-type QueryParamsArray from UriTypeAliases
 */
interface Uri extends Stringable
{
    /**
     * The scheme (e.g., `https` or `urn`).
     */
    public string $scheme { get; }

    /**
     * The user name.
     */
    public string $user { get; }

    /**
     * The password.
     */
    public string $password { get; }

    /**
     * The hostname or IP address (e.g. `www.example.net`, `127.0.0.1`, or `::1`).
     */
    public string $host { get; }

    /**
     * The port (e.g. `443`).
     */
    public ?int $port { get; }

    /**
     * The path (e.g. `/path/to/page.html` or `ietf:rfc:3986`).
     */
    public string $path { get; }

    /**
     * The query string (e.g. `foo=bar&baz=qux`).
     */
    public string $query { get; }

    /**
     * The fragment.
     */
    public string $fragment { get; }

    /**
     * The query string decoded into an array.
     *
     * @var QueryParamsArray
     */
    public array $queryParams { get; }

    /**
     * The combined `$user` and `$password` (e.g., as specified by
     * <https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2.1>.
     */
    public string $userInfo { get; }

    /**
     * The combined `$userInfo`, `$host`, and `$port` (e.g., as specified by
     * <https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2>).
     */
    public string $authority  { get; }

    /**
     * Returns all the components composed into a string.
     */
    public function __toString() : string;
}
