<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

/**
 * Implementations MAY sanitize component values (e.g. by applying `trim()`).
 *
 * Implementations MAY validate component values; the implementation MUST throw
 * _LogicException_ (or an extension thereof) when a component value is
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
     * The scheme component value (e.g., `https` or `urn`); does not include
     * the `:` separator.
     *
     * Implementations MUST report this value as `null` if the scheme component
     * is not present.
     */
    public ?string $scheme { get; }

    /**
     * The user component value.
     *
     * Implementations MUST report this value as `null` if the user component
     * is not present.
     *
     * @var ?decoded_string
     */
    public ?string $user { get; }

    /**
     * The password component value.
     *
     * Implementations MUST report this value as `null` if the password
     * component is not present.
     */
    public ?string $password { get; }

    /**
     * The host component value (e.g. `www.example.net`, `127.0.0.1`, `::1`, and so on).
     *
     * Implementations MUST report this value as `null` if the host component
     * is not present.
     *
     * @var ?decoded_string
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
     * @var composed_string
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
     * @var ?decoded_string
     */
    public ?string $fragment { get; }

    /**
     * The path component value represented as a sequential array.
     *
     * @var path_segments_array
     */
    public array $pathSegments { get; }

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
     * The recomposed `$user` and `$password` (e.g. as per [RFC 3986][]); does
     * not include the `@` separator.
     *
     * Implementations MUST report this value as `null` if both `$user` and
     * `$password` are `null`.
     *
     * @var ?composed_string
     */
    public ?string $userInfo { get; }

    /**
     * The recomposed `$userInfo`, `$host`, and `$port` (e.g. as per
     * [RFC 3986][]); does not include the `//` separator.
     *
     * Implementations MUST report this value as `null` if `$userInfo`,
     * `$host`, and `$port` are all `null`.
     *
     * @var ?composed_string
     */
    public ?string $authority  { get; }

    /**
     * Composes the component values into a full URI string.
     *
     * Implementations SHOULD return `percent_composed_string` but MAY return
     * `formurl_composed_string` (or combinations thereof).
     *
     * @return composed_string
     */
    public function __toString() : string;
}
