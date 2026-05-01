<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Stringable;

/**
 * [_UriStruct_][] affords reading of URI component values and
 * recomposing them into a string.
 *
 * - Directives:
 *
 *     - Implementations MAY sanitize component values (e.g. by applying
 *       [`trim()`][]).
 *
 *     - Implementations MAY [normalize component values][].
 *
 *     - Implementations MAY validate component values; implementations doing
 *       so MUST throw a [_UriThrowable_][] when a component value is invalid.
 *
 * - Notes:
 *
 *     - **These are property get hooks, not getter methods.** The property
 *       values are straightforward and require little-to-no logic around
 *       getting in most cases. Further, use of the `$queryParams` property
 *       looks more like idiomatic PHP; e.g., `$uri->queryParams['foo'] ?? 'bar'`
 *       and not `$uri->queryParams()['foo']` or
 *       `$uri->queryParams('foo', 'bar')`.
 *
 *     - **Most component values are nullable.** This preserves the
 *       distinction between the state of a component that is present but
 *       empty (e.g. as by an empty string) and that of a component not being
 *       present at all (represented by `null`). Note that `$path` is always
 *       considered present (though it may be empty).
 *
 *     - **The query component is a `composed_string`.** Emulating a form
 *       submission might require using form-url-encoded values, so the query
 *       component may be composed of form-url-encoded values or
 *       percent-encoded values.
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
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the scheme
     *       component is not present.
     */
    public ?string $scheme { get; }

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
    public ?string $username { get; }

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
    public ?string $password { get; }

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
    public ?string $host { get; }

    /**
     * The port component value (e.g. `443`).
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if the port
     *       component is not present.
     */
    public ?int $port { get; }

    /**
     * The path component value (e.g. `/path/to/page.html`, `ietf:rfc:3986`,
     * `username@example.net`, and so on).
     *
     * @var percent_composed_string
     */
    public string $path { get; }

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
    public ?string $query { get; }

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
    public ?string $fragment { get; }

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
    public ?array $queryParams { get; }

    /**
     * The recomposed `$username` and `$password`; does not include the `@`
     * separator.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if both
     *       `$username` and `$password` are `null`.
     *
     * @var ?percent_composed_string
     */
    public ?string $userinfo { get; }

    /**
     * The recomposed `$userinfo`, `$host`, and `$port`; does not include the
     * `//` separator.
     *
     * - Directives:
     *
     *     - Implementations MUST report this value as `null` if `$userinfo`,
     *       `$host`, and `$port` are all `null`.
     *
     * @var ?percent_composed_string
     */
    public ?string $authority { get; }

    /**
     * Composes the component values into a full URI string.
     *
     * @return composed_string
     */
    public function __toString() : string;
}
