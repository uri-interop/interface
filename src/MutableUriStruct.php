<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * [_MutableUriStruct_][] extends [_UriStruct_][] to afford direct
 * modification of component values via property set hooks.
 *
 * - Directives:
 *
 *     - Implementations MUST keep `$query` and `$queryParams` in sync; if
 *       one is modified, the other MUST be modified accordingly.
 *
 * - Notes:
 *
 *     - **These are property set hooks, not setter methods.** The property
 *       values are straightforward and require little-to-no logic around
 *       setting in most cases.
 *
 *     - **There are no property set hooks for `$userinfo` or `$authority`.**
 *       Because these are combined from other component values, they are not
 *       modified directly.
 *
 * @phpstan-import-type composed_string from UriTypeAliases
 * @phpstan-import-type percent_composed_string from UriTypeAliases
 * @phpstan-import-type percent_encoded_string from UriTypeAliases
 * @phpstan-import-type query_params_array from UriTypeAliases
 */
interface MutableUriStruct extends UriStruct
{
    /**
     * The scheme component value (e.g., `https` or `urn`); does not include
     * the `:` separator.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the scheme
     *       component is not present.
     */
    public ?string $scheme { get; set; }

    /**
     * The username component value.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the username
     *       component is not present.
     *
     * @var ?percent_encoded_string
     */
    public ?string $username { get; set; }

    /**
     * The password component value.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the password
     *       component is not present.
     *
     * @var ?percent_encoded_string
     */
    public ?string $password { get; set; }

    /**
     * The host component value (e.g. `www.example.net`, `127.0.0.1`, `[::1]`,
     * and so on).
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the host
     *       component is not present.
     *
     * @var ?percent_composed_string
     */
    public ?string $host { get; set; }

    /**
     * The port component value (e.g. `443`).
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the port
     *       component is not present.
     */
    public ?int $port { get; set; }

    /**
     * The path component value (e.g. `/path/to/page.html`, `ietf:rfc:3986`,
     * `username@example.net`, and so on).
     *
     * @var percent_composed_string
     */
    public string $path { get; set; }

    /**
     * The query component value (e.g. `foo=bar&baz=qux`); does not include
     * the `?` separator.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the query
     *       component is not present.
     *
     * @var ?composed_string
     */
    public ?string $query { get; set; }

    /**
     * The fragment component value; does not include the `#` separator.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the fragment
     *       component is not present.
     *
     * @var ?percent_composed_string
     */
    public ?string $fragment { get; set; }

    /**
     * The query component value represented as an associative array.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the query
     *       component is not present.
     *
     * @var ?query_params_array
     */
    public ?array $queryParams { get; set; }
}
