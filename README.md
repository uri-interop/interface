# Uri-Interop Interface Package

[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)
[![PDS Composer Script Names](https://img.shields.io/badge/pds-composer--script--names-blue?style=flat-square)](https://github.com/php-pds/composer-script-names)

The Uri-Interop project publishes a standard set of interoperable URI interfaces for PHP 8.4+. It reflects, refines, and reconciles the common practices identified within [several pre-existing projects][README-RESEARCH.md].

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED",  "MAY", and "OPTIONAL" in this document are to be interpreted as described in [BCP 14][] ([RFC 2119][], [RFC 8174][]).

This package attempts to adhere to the [Package Development Standards](https://php-pds.com/) approach to [naming and versioning](https://php-pds.com/#naming-and-versioning).

## Interfaces

Uri-Interop defines separate interfaces to afford reading and modifying URI component values:

- [_Uri_](#uri) affords reading of the URI component values and recomposing them into a string.
- [_MutableUri_](#mutableuri) extends _Uri_ to afford direct modification of component values.
- [_ImmutableUri_](#immutableuri) extends _Uri_ to afford immutable modification of component values.

It also defines these marker interfaces to codify expectations around component values and string recomposition:

- [_Rfc3986Uri_](#rfc3986uri) marks a _Uri_ to indicate it conforms to [RFC 3986][].
- [_Rfc3987Uri_](#rfc3987uri) marks a _Uri_ to indicate it conforms to [RFC 3987][].
- [_Url_](#url) marks a _Uri_ to indicate a scheme is required.
- [_WhatwgUrl_](#whatwgurl) marks a _Url_ to indicate it conforms to [WHATWG-URL][].

Uri-Interop defines factory and parser interfaces:

- [_UriFactory_](#urifactory) affords creating a new URI instance from URI component values.
- [_UriParser_](#uriparser) affords creating a new URI instance from a URI string.

Finally, it defines an interface of PHPStan type aliases, [_UriTypeAliases_](#uritypealiases), to aid static analysis.

### _Uri_

The _Uri_ interface affords readability of URI components using these properties and methods:

- `string $scheme { get; }`
    - The scheme (e.g., `https` or `urn`); does not include the `:` separator.

- `uri_decoded_string $user { get; }`
    - The user name.

- `uri_decoded_string $password { get; }`
    - The password.

- `uri_decoded_string $host { get; }`
    - The hostname or IP address (e.g. `www.example.net`, `127.0.0.1`, `::1`, and so on).

- `?int $port { get; }`
    - The port (e.g. `443`).

- `uri_composed_string $path { get; }`
    - The path (e.g. `/path/to/page.html`, `ietf:rfc:3986`, `user@example.net`, and so on).

- `uri_composed_string $query { get; }`
    - The query string (e.g. `foo=bar&baz=qux`); does not include the `?` separator.

- `string $fragment { get; }`
    - The fragment; does not include the `#` separator.

- `uri_query_params_array $queryParams { get; }`
    - The `$query` string decomposed as an array.

- `uri_percent_composed_string $userInfo { get; }`
    - The composed `$user` and `$password` (e.g. as per [RFC 3986][]).

- `uri_percent_composed_string $authority { get; }`
    - The composed `$userInfo`, `$host`, and `$port` (e.g. as per [RFC 3986][]).

- `__toString() : uri_percent_composed_string`
    - Composes the component values into a full URI string.

Implementations MAY sanitize component values (e.g. by applying [`trim()`][]).

Implementations MAY validate component values; the implementation MUST throw _LogicException_ (or an extension thereof) when the component value is invalid.

Notes:

- **These are property get hooks, not getter methods.** The property values are straightforward and require little-to-no logic around getting in most cases. Further, use of the `$queryParams` property looks more like idiomatic PHP; e.g., `$uri->queryParams['foo'] ?? 'bar'` and not `$uri->queryParams()['foo']` or `$uri->queryParams('foo', 'bar')`.

### _MutableUri_

The _MutableUri_ interface extends _Uri_ to afford these property set hooks:

- `string $scheme { get; set; }`
- `uri_decoded_string $host { get; set; }`
- `?int $port { get; set; }`
- `uri_decoded_string $user { get; set; }`
- `uri_decoded_string $password { get; set; }`
- `uri_composed_string $path { get; set; }`
- `uri_composed_string $query { get; set; }`
- `string $fragment { get; set; }`
- `uri_query_params_array $queryParams { get; set; }`

Implementations MUST keep `$queryParams` and `$query` in sync; if one is modified, the other MUST be modified accordingly.

Notes:

- **These are property set hooks, not setter methods.** The property values are straightforward and require little-to-no logic around setting in most cases.

- **There are no property set hooks for `$userInfo` or `$authority`.** Because these are combined from other component values, they are not modified directly.

### _ImmutableUri_

The _ImmutableUri_ interface extends _Uri_ to afford these methods:

- `withScheme(string $scheme) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$scheme` value.

- `withUser(uri_decoded_string $user) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$user` value.

- `withPassword(uri_decoded_string $password) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$password` value.
    - The `$password` argument MUST be treated as already decoded.

- `withHost(uri_decoded_string $host) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$host` value.
    - The `$host` argument MUST be treated as already decoded.

- `withPort(?int $port) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$port` value.

- `withPath(uri_composed_string $path) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$path` value.
    - The `$path` argument MUST be treated as already **encoded**.

- `withQuery(uri_composed_string $query) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$query` value.
    - The `$query` argument MUST be treated as already **encoded**.

- `withFragment(string $fragment) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$fragment` value.

- `withQueryParams(uri_query_params_array $queryParams) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the decode `$queryParams` value.
    - The `$queryParams` argument MUST be treated as already decoded.

Implementations MUST keep `$queryParams` and `$query` in sync; if one is modified, the other MUST be modified accordingly.

Notes:

- **There are no methods for `withUserInfo()` or `withAuthority()`.** Because these are combined from other property values, they are not modified directly.

### _Rfc3986Uri_

The _Rfc3986Uri_ marker interface extends _Uri_; it adds no properties or methods.

Implementations with this marker interface MUST conform to [RFC 3986][].

### _Rfc3987Uri_

The _Rfc3987Uri_ marker interface extends _Uri_; it adds no properties or methods.

Implementations with this marker interface MUST conform to [RFC 3987][].

### _Url_

The _Url_ marker interface extends _Uri_ to indicate a scheme component must be present; it adds no properties or methods.

Implmentations with this marker interface MUST throw _LogicException_ (or an extension thereof) if `$scheme` is empty or consists only of whitespace.

### _WhatwgUrl_

The _WhatwgUrl_ marker interface extends _Url_ (not _Uri_); it adds no properties or methods.

Implementations with this marker interface MUST conform to [WHATWG-URL][].

### _UriFactory_

The _UriFactory_ interface affords creating a new _Uri_ instance from parsed component values:

-
    ```php
    newUri(
        string $scheme = '',
        uri_decoded_string $user = '',
        uri_decoded_string $password = '',
        uri_decoded_string $host = '',
        ?int $port = null,
        uri_composed_string $path = '',
        uri_composed_string $query = '',
        string $fragment = '',
    ) : Uri
    ```

### _UriParser_

The _UriParser_ interface affords creating a new _Uri_ instance from a URI string:

- `parseUri(string|Stringable $uriString) : Uri`

Notes:

- **The parser returns a new _Uri_ instance instead of an array of component values.** This reduces the number of steps involved in creating a new _Uri_ instance. If needed, _Uri_ instance properties can be used in place of an array of component values.

### _UriTypeAliases_

The _UriTypeAliases_ interface defines these PHPStan type aliases to aid static analysis:

- `uri_composed_string`
    - a `uri_form_url_composed_string` or `uri_percent_composed_string`

- `uri_decoded_string`
    - the result of decoding a `uri_encoded_string` as via [`urldecode()`][].

- `uri_encoded_string`
    - a `uri_form_url_encoded_string` or `uri_percent_encoded_string`.

- `uri_form_url_composed_string`
    - a concatenation of `uri_form_url_encoded_string`s and `string` separators.

- `uri_form_url_encoded_string`
    - an `application/x-www-form-urlencoded` string, with  `+` for the space character as via [`urlencode()`][].

- `uri_percent_composed_string`
    - a concatenation of `uri_percent_encoded_string`s and `string` separators.

- `uri_percent_encoded_string`
    - a percent-encoded string, with `%20` for the space character as via [`rawurlencode()`][].

- `uri_query_params_array`
    - an array of up to 16 dimensions with `uri_decoded_string` keys and `uri_decoded_string` values.

Notes:

- **Native PHP functions will suffice for the type aliases.**

    - [`http_build_query()`][] with `encoding_type: PHP_QUERY_3986` will encode each space character as `%20`, returning a `uri_percent_encoded_string`.
    - [`parse_str()`][] will decode both `+` and `%20` to a space character, returning a `uri_query_params_array`.
    - [`rawurlencode()`][]  will encode each space character as `%20`, returning a `uri_percent_encoded_string`.
    - [`urldecode()`][] will decode both `+` and `%20` to a space character, returning a `uri_decoded_string`.

## Implementations

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
