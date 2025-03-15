# Uri-Interop Interface Package

[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)
[![PDS Composer Script Names](https://img.shields.io/badge/pds-composer--script--names-blue?style=flat-square)](https://github.com/php-pds/composer-script-names)

Uri-Interop publishes a standard set of interoperable URI and IRI interfaces for PHP 8.4+. It reflects, refines, and reconciles the common practices identified within [several pre-existing projects][README-RESEARCH.md].

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED",  "MAY", and "OPTIONAL" in this document are to be interpreted as described in [BCP 14][] ([RFC 2119][], [RFC 8174][]).

This package attempts to adhere to the [Package Development Standards](https://php-pds.com/) approach to [naming and versioning](https://php-pds.com/#naming-and-versioning).

## Interfaces

Uri-Interop defines separate interfaces to afford reading and modifying URI and IRI component values:

- [_StringableComponents_][] affords reading of the component values and recomposing them into a string.
- [_MutableComponents_][] extends [_StringableComponents_][] to afford direct modification of component values.
- [_ImmutableComponents_][] extends [_StringableComponents_][] to afford immutable modification of component values.

Uri-Interop defines two marker interfaces to indicate the expected character composition and percent-encoding rules:

- [_UriEncoded_][] marks implementations that are expected to work with ASCII characters only, per [RFC 3986][].
- [_IriEncoded_][] marks implementations that are expected to work with characters from the Universal Character Set (Unicode/ISO 10646) per [RFC 3987][].

Uri-Interop defines factory and parser interfaces for URIs:

- [_UriEncodedFactory_][] affords creating a new URI instance from URI component values.
- [_UriEncodedParser_][] affords creating a new URI instance from a URI string.

Uri-Interop defines factory and parser interfaces for IRIs:

- [_IriEncodedFactory_][] affords creating a new IRI instance from IRI component values.
- [_IriEncodedParser_][] affords creating a new IRI instance from an IRI string.

Finally, Uri-Interop defines an interface of PHPStan type aliases, [_UriTypeAliases_](#uritypealiases), to aid static analysis.

### _StringableComponents_

The [_StringableComponents_][] interface affords readability and recomposition of URI and IRI components using these properties and methods:

- `?string $scheme { get; }`
    - The scheme component value (e.g., `https` or `urn`); does not include the `:` separator.
    - Implementations MUST report this value as `null` if the scheme component is not present.

- `?percent_encoded_string $user { get; }`
    - The user component value.
    - Implementations MUST report this value as `null` if the user component is not present.

- `?percent_encoded_string $password { get; }`
    - The password component value.
    - Implementations MUST report this value as `null` if the password component is not present.

- `?percent_encoded_string $host { get; }`
    - The host component value (e.g. `www.example.net`, `127.0.0.1`, `[::1]`, and so on).
    - Implementations MUST report this value as `null` if the host component is not present.

- `?int $port { get; }`
    - The port component value (e.g. `443`).
    - Implementations MUST report this value as `null` if the port component is not present.

- `percent_composed_string $path { get; }`
    - The path component value (e.g. `/path/to/page.html`, `ietf:rfc:3986`, `user@example.net`, and so on).

- `?composed_string $query { get; }`
    - The query component value (e.g. `foo=bar&baz=qux`); does not include the `?` separator.
    - Implementations MUST report this value as `null` if the query component is not present.

- `?percent_composed_string $fragment { get; }`
    - The fragment component value; does not include the `#` separator.
    - Implementations MUST report this value as `null` if the fragment component is not present.

- `?query_params_array $queryParams { get; }`
    - The query component value represented an associative array.
    - Implementations MUST report this value as `null` if the query component is not present.

- `?percent_composed_string $userInfo { get; }`
    - The recomposed `$user` and `$password` (as per [RFC 3986][]); does not include the `@` separator.
    - Implementations MUST report this value as `null` if both `$user` and `$password` are `null`.

- `?percent_composed_string $authority { get; }`
    - The recomposed `$userInfo`, `$host`, and `$port` (as per [RFC 3986][]); does not include the `//` separator.
    - Implementations MUST report this value as `null` if `$userInfo`, `$host`, and `$port` are all `null`.

- `__toString() : composed_string`
    - Composes the component values into a full URI string.

Notes:

- **These are property get hooks, not getter methods.** The property values are straightforward and require little-to-no logic around getting in most cases. Further, use of the `$queryParams`  property looks more like idiomatic PHP; e.g., `$uri->queryParams['foo'] ?? 'bar'` and not `$uri->queryParams()['foo']` or `$uri->queryParams('foo', 'bar')`.

- **Most component values are nullable.** This preserves the distinction between the state of a component that is present but empty (e.g. as by an empty string) and that of a component not being present at all (represented by `null`). Note that `$path` is always considered present (though it may be empty).

- **The query component is a `composed_string`.** Emulating a form submission might require using form-url-encoded values, so the query component may be composed of form-url-encoded values or percent-encoded values.

### _MutableComponents_

The [_MutableComponents_][] interface extends [_StringableComponents_][] to afford these property set hooks:

- `?string $scheme { get; set; }`
- `?percent_encoded_string $host { get; set; }`
- `?int $port { get; set; }`
- `?percent_encoded_string $user { get; set; }`
- `?percent_encoded_string $password { get; set; }`
- `percent_composed_string $path { get; set; }`
- `?composed_string $query { get; set; }`
- `?percent_composed_string $fragment { get; set; }`
- `?query_params_array $queryParams { get; set; }`

Implementations MUST keep `$query` and `$queryParams` in sync; if one is modified, the other MUST be modified accordingly.

Notes:

- **These are property set hooks, not setter methods.** The property values are straightforward and require little-to-no logic around setting in most cases.

- **There are no property set hooks for `$userInfo` or `$authority`.** Because these are combined from other component values, they are not modified directly.

### _ImmutableComponents_

The [_ImmutableComponents_][] interface extends [_StringableComponents_][] to afford these methods:

- `withScheme(?string $scheme) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$scheme` value.

- `withUser(?percent_encoded_string $user) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$user` value.

- `withPassword(?percent_encoded_string $password) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$password` value.

- `withHost(?percent_encoded_string $host) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$host` value.

- `withPort(?int $port) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$port` value.

- `withPath(percent_composed_string $path) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$path` value.

- `withQuery(?composed_string $query) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$query` value.
    - Implementations MUST keep `$query` and `$queryParams` in sync; if one is modified, the other MUST be modified accordingly.

- `withFragment(?percent_composed_string $fragment) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$fragment` value.

- `withQueryParams(?query_params_array $queryParams) : ImmutableComponents`
    - Returns a new instance of the [_ImmutableComponents_][] with the modified `$queryParams` value.
    - Implementations MUST keep `$query` and `$queryParams` in sync; if one is modified, the other MUST be modified accordingly.

Notes:

- **There are no methods for `withUserInfo()` or `withAuthority()`.** Because these are combined from other property values, they are not modified directly.

### _UriEncoded_

The [_UriEncoded_] interface marks implementations where the component values are expected to consist only of ASCII characters. It defines no additional properties or methods.

Notes:

**This marker interface indicates a URI implementation.** Component values, parsing and recomposition, and percent-encoding strategies are expected to comply with [RFC 3986][].

### _IriEncoded_

The [_IriEncoded_] interface marks implementations where the component values are expected to consist of characters from the Universal Character Set (Unicode/ISO 10646) as per [RFC 3987][], instead of only ASCII characters. It defines no additional properties or methods.

Notes:

**This marker interface indicates an IRI implementation.** Component values, parsing and recomposition, and percent-encoding strategies are expected to comply with [RFC 3987][].

### _UriEncodedFactory_

The [_UriEncodedFactory_][] interface extends [_UriEncoded_][] to afford creating a new instance of [_UriEncoded_][]_&_[_StringableComponents_][] from parsed component values:

-
    ```php
    newUri(
        ?string $scheme = null,
        ?percent_encoded_string $user = null,
        ?percent_encoded_string $password = null,
        ?percent_encoded_string $host = null,
        ?int $port = null,
        percent_composed_string $path = '',
        ?composed_string $query = null,
        ?percent_composed_string $fragment = null,
    ) : UriEncoded&StringableComponents
    ```

### _UriEncodedParser_

The [_UriEncodedParser_][] interface extends [_UriEncoded_][] to afford creating a new instance of [_UriEncoded_][]_&_[_StringableComponents_][] from a URI string:

- `parseUri(string|Stringable $uriString) : UriEncoded&StringableComponents`

Notes:

- **The parser returns a new instance of [_UriEncoded_][]_&_[_StringableComponents_][] instead of an array of component values.** This reduces the number of steps involved in creating a new instance.

- **The native [`parse_url()`][] PHP function is not strictly [RFC 3986][] compliant.** Using [`parse_url()`][] may be fine for many cases, but implementations should consider using an [RFC 3986][]-compliant approach instead.

### _IriEncodedFactory_

The [_IriEncodedFactory_][] interface extends [_IriEncoded_][] to afford creating a new instance of [_IriEncoded_][]_&_[_StringableComponents_][] from parsed component values:

-
    ```php
    newIri(
        ?string $scheme = null,
        ?percent_encoded_string $user = null,
        ?percent_encoded_string $password = null,
        ?percent_encoded_string $host = null,
        ?int $port = null,
        percent_composed_string $path = '',
        ?composed_string $query = null,
        ?percent_composed_string $fragment = null,
    ) : IriEncoded&StringableComponents
    ```

### _IriEncodedParser_

The [_IriEncodedParser_][] interface extends [_IriEncoded_][] to afford creating a new instance of [_IriEncoded_][]_&_[_StringableComponents_][] from a URI string:

- `parseIri(string|Stringable $iriString) : IriEncoded&StringableComponents`

Notes:

- **The parser returns a new instance of [_IriEncoded_][]_&_[_StringableComponents_][] instead of an array of component values.** This reduces the number of steps involved in creating a new instance.

### _UriTypeAliases_

The [_UriTypeAliases_][] interface defines these PHPStan type aliases to aid static analysis:

- `composed_string`
    - A concatenation of `encoded_string`s with component-appropriate `string` separators.

- `decoded_string`
    - The result of decoding an `encoded_string`.

- `encoded_string`
    - A `formurl_encoded_string` or `percent_encoded_string`.

- `formurl_composed_string`
    - A concatenation of `formurl_encoded_string`s with component-appropriate `string` separators.

- `formurl_encoded_string`
    - An `application/x-www-form-urlencoded` string, with  `+` for the space character.

- `parse_url_array`
    - The array return from [`parse_url()`][].

- `percent_composed_string`
    - A concatenation of `percent_encoded_string`s with component-appropriate `string` separators.

- `percent_encoded_string`
    - A percent-encoded string, with `%20` for the space character.

- `query_params_array`
    - An associative array of up to 16 dimensions with `decoded_string` keys and `decoded_string` values.

Notes:

- **Native PHP functions will suffice for the type aliases regarding [_UriEncoded_][] components.** Implementations MAY provide their own alternative functionality.

    - [`http_build_query()`][] with `encoding_type: PHP_QUERY_1738` will encode each space character as `+`, returning a `formurl_encoded_string`.
    - [`http_build_query()`][] with `encoding_type: PHP_QUERY_3986` will encode each space character as `%20`, returning a `percent_encoded_string` for the relevant [_UriEncoded_][] components.
    - [`parse_str()`][] will decode both `+` and `%20` to a space character, returning a `query_params_array` for the relevant [_UriEncoded_][] components.
    - [`rawurlencode()`][]  will encode each space character as `%20`, returning a `percent_encoded_string` for the relevant [_UriEncoded_][] components.
    - [`urldecode()`][] will decode both `+` and `%20` to a space character, returning a `decoded_string`.
    - [`urlencode()`][]  will encode each space character as `+`, returning a `formurl_encoded_string`.

- **Percent-encoding requirements are different for [_UriEncoded_][] and [_IriEncoded_][] components.** UCS [_IriEncoded_][] components need percent-encoding on a different of characters than ASCII-only [_UriEncoded_][] components. Please consult the relevant RFCs for the expectations here.

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

[_ImmutableComponents_]: #immutablecomponents
[_IriEncoded_]: #iriencoded
[_IriEncodedFactory_]: #iriencodedfactory
[_IriEncodedParser_]: #iriencodedparser
[_MutableComponents_]: #mutablecomponents
[_StringableComponents_]: #stringablecomponents
[_UriEncoded_]: #uriencoded
[_UriEncodedFactory_]: #uriencodedfactory
[_UriEncodedParser_]: #uriencodedparser
[_UriTypeAliases_]: #uritypealiases
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
