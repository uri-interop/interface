<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

/**
 * Implementations MAY sanitize component values (e.g. by applying `trim()`).
 *
 * Implementations MAY validate component values; the implementation MUST throw
 * a _UriThrowable_ when a component value is invalid.
 *
 * @phpstan-import-type composed_string from UriTypeAliases
 * @phpstan-import-type percent_composed_string from UriTypeAliases
 * @phpstan-import-type percent_encoded_string from UriTypeAliases
 * @phpstan-import-type query_params_array from UriTypeAliases
 */
interface UriStruct extends Stringable
{
    /**
     * The scheme component value (e.g., `https` or `urn`); does not include
     * the `:` separator.
     *
     * Implementations MUST report this value as `null` if the scheme component
     * is not present.
     */
    public ?string $scheme { get; }

    /**
     * The username component value.
     *
     * Implementations MUST report this value as `null` if the username component
     * is not present.
     *
     * @var ?percent_encoded_string
     */
    public ?string $username { get; }

    /**
     * The password component value.
     *
     * Implementations MUST report this value as `null` if the password
     * component is not present.
     *
     * @var ?percent_encoded_string
     */
    public ?string $password { get; }

    /**
     * The host component value (e.g. `www.example.net`, `127.0.0.1`, `::1`, and so on).
     *
     * Implementations MUST report this value as `null` if the host component
     * is not present.
     *
     * @var ?percent_composed_string
     */
    public ?string $host { get; }

    /**
     * The port component value (e.g. `443`).
     *
     * Implementations MUST report this value as `null` if the port component
     * is not present.
     */
    public ?int $port { get; }

    /**
     * The path component value (e.g. `/path/to/page.html`, `ietf:rfc:3986`,
     * `user@example.net`, and so on).
     *
     * @var percent_composed_string
     */
    public string $path { get; }

    /**
     * The query component value (e.g. `foo=bar&baz=qux`); does not include the
     * `?` separator.
     *
     * Implementations MUST report this value as `null` if the query component
     * is not present.
     *
     * @var ?composed_string
     */
    public ?string $query { get; }

    /**
     * The fragment component value; does not include the `#` separator.
     *
     * Implementations MUST report this value as `null` if the fragment
     * component is not present.
     *
     * @var ?percent_composed_string
     */
    public ?string $fragment { get; }

    /**
     * The query component value represented an associative array.
     *
     * Implementations MUST report this value as `null` if the query component
     * is not present.
     *
     * @var ?query_params_array
     */
    public ?array $queryParams { get; }

    /**
     * The recomposed `$username` and `$password` (as per RFC 3986); does
     * not include the `@` separator.
     *
     * Implementations MUST report this value as `null` if both `$username` and
     * `$password` are `null`.
     *
     * @var ?percent_composed_string
     */
    public ?string $userinfo { get; }

    /**
     * The recomposed `$userinfo`, `$host`, and `$port` (as per
     * RFC 3986); does not include the `//` separator.
     *
     * Implementations MUST report this value as `null` if `$userinfo`,
     * `$host`, and `$port` are all `null`.
     *
     * @var ?percent_composed_string
     */
    public ?string $authority  { get; }

    /**
     * Composes the component values into a full URI string.
     *
     * @return composed_string
     */
    public function __toString() : string;
}
