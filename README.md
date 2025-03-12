# Uri-Interop Interface Package

[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)
[![PDS Composer Script Names](https://img.shields.io/badge/pds-composer--script--names-blue?style=flat-square)](https://github.com/php-pds/composer-script-names)

Uri-Interop publishes a standard set of interoperable URI interfaces for PHP 8.4+. It reflects, refines, and reconciles the common practices identified within [several pre-existing projects][README-RESEARCH.md].

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED",  "MAY", and "OPTIONAL" in this document are to be interpreted as described in [BCP 14][] ([RFC 2119][], [RFC 8174][]).

This package attempts to adhere to the [Package Development Standards](https://php-pds.com/) approach to [naming and versioning](https://php-pds.com/#naming-and-versioning).

## Interfaces

Uri-Interop defines separate interfaces to afford reading and modifying URI component values:

- [_Uri_](#uri) affords reading of the URI component values and recomposing them into a string.
- [_MutableUri_](#mutableuri) extends _Uri_ to afford direct modification of component values.
- [_ImmutableUri_](#immutableuri) extends _Uri_ to afford immutable modification of component values.

Uri-Interop defines factory and parser interfaces:

- [_UriFactory_](#urifactory) affords creating a new URI instance from URI component values.
- [_UriParser_](#uriparser) affords creating a new URI instance from a URI string.

Uri-Interop defines these marker interfaces to codify expectations around RFC compliance:

- [_Rfc3986Compliant_](#rfc3986compliant) marks any of the other interfaces to indicate [RFC 3986][] compliance.
- [_Rfc3987Compliant_](#rfc3987compliant) marks any of the other interfaces to indicate [RFC 3987][] compliance.

Finally, Uri-Interop defines an interface of PHPStan type aliases, [_UriTypeAliases_](#uritypealiases), to aid static analysis.

### _Uri_

The _Uri_ interface affords readability and recomposition of URI components using these properties and methods:

- `?string $scheme { get; }`
    - The scheme component value (e.g., `https` or `urn`); does not include the `:` separator.
    - Implementations MUST report this value as `null` if the scheme component is not present.

- `?encoded_string $user { get; }`
    - The user component value.
    - Implementations MUST report this value as `null` if the user component is not present.

- `?encoded_string $password { get; }`
    - The password component value.
    - Implementations MUST report this value as `null` if the password component is not present.

- `?encoded_string $host { get; }`
    - The host component value (e.g. `www.example.net`, `127.0.0.1`, `::1`, and so on).
    - Implementations MUST report this value as `null` if the host component is not present.

- `?int $port { get; }`
    - The port component value (e.g. `443`).
    - Implementations MUST report this value as `null` if the port component is not present.

- `composed_string $path { get; }`
    - The path component value (e.g. `/path/to/page.html`, `ietf:rfc:3986`, `user@example.net`, and so on).

- `?composed_string $query { get; }`
    - The query component value (e.g. `foo=bar&baz=qux`); does not include the `?` separator.
    - Implementations MUST report this value as `null` if the query component is not present.

- `?composed_string $fragment { get; }`
    - The fragment component value; does not include the `#` separator.
    - Implementations MUST report this value as `null` if the fragment component is not present.

- `path_segments_array $pathSegments { get; }`
    - The path component value represented as a sequential array.
    - Implementations MUST report this value as `null` if the path component is not present.

- `?query_params_array $queryParams { get; }`
    - The query component value represented an associative array.
    - Implementations MUST report this value as `null` if the query component is not present.

- `?composed_string $userInfo { get; }`
    - The recomposed `$user` and `$password` (e.g. as per [RFC 3986][]); does not include the `@` separator.
    - Implementations MUST report this value as `null` if both `$user` and `$password` are `null`.

- `?composed_string $authority { get; }`
    - The recomposed `$userInfo`, `$host`, and `$port` (e.g. as per [RFC 3986][]); does not include the `//` separator.
    - Implementations MUST report this value as `null` if `$userInfo`, `$host`, and `$port` are all `null`.

- `__toString() : composed_string`
    - Composes the component values into a full URI string.
    - Implementations SHOULD return `percent_composed_string` but MAY return `formurl_composed_string` (or combinations thereof).

Notes:

- **These are property get hooks, not getter methods.** The property values are straightforward and require little-to-no logic around getting in most cases. Further, use of the `$queryParams` and `$pathSegments` properties look more like idiomatic PHP; e.g., `$uri->queryParams['foo'] ?? 'bar'` and not `$uri->queryParams()['foo']` or `$uri->queryParams('foo', 'bar')`.

- **Most component values are nullable.** This preserves the distinction between the state of a component that is present but empty (e.g. as by an empty string) and that of a component not being present at all (represented by `null`). Note that `$path` and `$pathSegments` are always considered present (though they may be empty).

### _MutableUri_

The _MutableUri_ interface extends _Uri_ to afford these property set hooks:

- `?string $scheme { get; set; }`
- `?encoded_string $host { get; set; }`
- `?int $port { get; set; }`
- `?encoded_string $user { get; set; }`
- `?encoded_string $password { get; set; }`
- `composed_string $path { get; set; }`
- `?composed_string $query { get; set; }`
- `?composed_string $fragment { get; set; }`
- `path_segments_array $pathSegments { get; set; }`
- `?query_params_array $queryParams { get; set; }`

Implementations MUST keep `$path` and `$pathSegments` in sync; if one is modified, the other MUST be modified accordingly.

Implementations MUST keep `$query` and `$queryParams` in sync; if one is modified, the other MUST be modified accordingly.

Notes:

- **These are property set hooks, not setter methods.** The property values are straightforward and require little-to-no logic around setting in most cases.

- **There are no property set hooks for `$userInfo` or `$authority`.** Because these are combined from other component values, they are not modified directly.

### _ImmutableUri_

The _ImmutableUri_ interface extends _Uri_ to afford these methods:

- `withScheme(?string $scheme) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$scheme` value.

- `withUser(?encoded_string $user) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$user` value.

- `withPassword(?encoded_string $password) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$password` value.

- `withHost(?encoded_string $host) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$host` value.

- `withPort(?int $port) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$port` value.

- `withPath(composed_string $path) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$path` value.
    - Implementations MUST keep `$path` and `$pathSegments` in sync; if one is modified, the other MUST be modified accordingly.

- `withQuery(?composed_string $query) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$query` value.
    - Implementations MUST keep `$query` and `$queryParams` in sync; if one is modified, the other MUST be modified accordingly.

- `withFragment(?composed_string $fragment) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$fragment` value.

- `withPathSegments(path_segments_array $pathSegments) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$pathSegments` value.
    - Implementations MUST keep `$path` and `$pathSegments` in sync; if one is modified, the other MUST be modified accordingly.

- `withQueryParams(?query_params_array $queryParams) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$queryParams` value.
    - Implementations MUST keep `$query` and `$queryParams` in sync; if one is modified, the other MUST be modified accordingly.

Notes:

- **There are no methods for `withUserInfo()` or `withAuthority()`.** Because these are combined from other property values, they are not modified directly.

### _UriFactory_

The _UriFactory_ interface affords creating a new _Uri_ instance from parsed component values:

-
    ```php
    newUri(
        ?string $scheme = null,
        ?encoded_string $user = null,
        ?encoded_string $password = null,
        ?encoded_string $host = null,
        ?int $port = null,
        composed_string $path = '',
        ?composed_string $query = null,
        ?composed_string $fragment = null,
    ) : Uri
    ```

### _UriParser_

The _UriParser_ interface affords creating a new _Uri_ instance from a URI string:

- `parseUri(string|Stringable $uriString) : Uri`

Notes:

- **The parser returns a new _Uri_ instance instead of an array of component values.** This reduces the number of steps involved in creating a new _Uri_ instance. If needed, _Uri_ instance properties can be used in place of an array of component values.

### _Rfc3986Compliant_

Implementations with this marker interface MUST conform to [RFC 3986][].

### _Rfc3987Compliant_

Implementations with this marker interface MUST conform to [RFC 3987][].

### _UriTypeAliases_

The _UriTypeAliases_ interface defines these PHPStan type aliases to aid static analysis:

- `composed_string`
    - A concatenation of `string`s and `encoded_string`s.

- `decoded_string`
    - The result of decoding an `encoded_string`.

- `encoded_string`
    - A `formurl_encoded_string` or `percent_encoded_string`.

- `formurl_composed_string`
    - A concatenation of `string`s and `formurl_encoded_string`s.

- `formurl_encoded_string`
    - An `application/x-www-form-urlencoded` string, with  `+` for the space character.

- `parse_url_array`
    - The array return from [`parse_url()`][].

- `path_segments_array`
    - A sequential array of `decoded_string`s.

- `percent_composed_string`
    - A concatenation of `string`s and `percent_encoded_string`s.

- `percent_encoded_string`
    - A percent-encoded string, with `%20` for the space character.

- `query_params_array`
    - An associative array of up to 16 dimensions with `decoded_string` keys and `decoded_string` values.

Notes:

- **Native PHP functions will suffice for the type aliases.** Implementations MAY provide their own alternative functionality.

    - [`http_build_query()`][] with `encoding_type: PHP_QUERY_1738` will encode each space character as `+`, returning a `formurl_encoded_string`.
    - [`http_build_query()`][] with `encoding_type: PHP_QUERY_3986` will encode each space character as `%20`, returning a `percent_encoded_string`.
    - [`parse_str()`][] will decode both `+` and `%20` to a space character, returning a `query_params_array`.
    - [`rawurlencode()`][]  will encode each space character as `%20`, returning a `percent_encoded_string`.
    - [`urldecode()`][] will decode both `+` and `%20` to a space character, returning a `decoded_string`.
    - [`urlencode()`][]  will encode each space character as `+`, returning a `formurl_encoded_string`.

## Implementations

Implementations MAY sanitize component values (e.g. by applying [`trim()`][]).

Implementations MAY validate component values; the implementation MUST throw _LogicException_ (or an extension thereof) when a component value is invalid.

Implementations MAY define additional properties and methods not defined in these interfaces.

Implementations advertised as readonly or immutable MUST be deeply readonly or immutable; they MUST NOT encapsulate any references, resources, mutable objects, objects or arrays encapsulating references or resources or mutable objects, and so on.

Notes:

- **Reflection does not invalidate advertisements of readonly or immutable implementations.** The ability of a consumer to use Reflection to mutate an implementation advertised as readonly or immutable does not constitute a failure to comply with Uri-Interop.

- **Reference implementations** may be found at <https://github.com/uri-interop/impl>.

## Q & A

### Why `$user` and not `$username`?

Among the researched projects, `$user` was the more common property name.

### Why `$password` and not `$pass`?

Among the researched projects, `$password` was the more common property name.

### Why `$userInfo` and not `$userinfo`?

Among the researched projects, most used camel-casing for this property and/or its associated methods, rather than all lower case.

### Why is WHATWG-URL not included here?

Earlier drafts of these standard interfaces included a [WHATWG-URL][] marker. However, there are enough differences between [WHATWG-URL][] and the [RFC 3986][]-like behaviors of the researched projects to warrant exclusion from this standard.

* * *

[`http_build_query()`]: https://php.net/http_build_query
[`parse_str()`]: https://php.net/parse_str
[`parse_url()`]: https://php.net/parse_url
[`rawurlencode()`]: https://php.net/rawurlencode
[`trim()`]: https://php.net/trim
[`urldecode()`]: https://php.net/urldecode
[`urlencode()`]: https://php.net/urlencode
[BCP 14]: https://www.rfc-editor.org/info/bcp14
[README-RESEARCH.md]: ./README-RESEARCH.md
[RFC 2119]: https://www.rfc-editor.org/rfc/rfc2119.txt
[RFC 3986]: https://datatracker.ietf.org/doc/html/rfc3986/
[RFC 3987]: https://datatracker.ietf.org/doc/html/rfc3987/
[RFC 8174]: https://www.rfc-editor.org/rfc/rfc8174.txt
[WHATWG-URL]: https://url.spec.whatwg.org/
