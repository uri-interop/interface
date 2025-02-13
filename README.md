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

Finally, it defines an interface of PHPStan type aliases, _UriTypeAliases_, to aid static analysis.

### _Uri_

The _Uri_ interface affords readability of URI components using these properties and methods:

- `string $scheme { get; }`
    - The scheme (e.g., `https` or `urn`).

- `string $user { get; }`
    - The user name.

- `string $password { get; }`
    - The password.

- `string $host { get; }`
    - The hostname or IP address (e.g. `www.example.net`, `127.0.0.1`, `::1`, and so on).

- `?int $port { get; }`
    - The port (e.g. `443`).

- `string $path { get; }`
    - The path (e.g. `/path/to/page.html` or `ietf:rfc:3986`).

- `string $query { get; }`
    - The query string (e.g. `foo=bar&baz=qux`).

- `string $fragment { get; }`
    - The fragment.

- `QueryParamsArray $queryParams { get; }`
    - A decoded form of `$query` (e.g., as if by [`parse_str()`][] or some other decoding mechanism).

- `string $userInfo { get; }`
    - The combined `$user` and `$password` (e.g. as per [RFC 3986][]).

- `string $authority { get; }`
    - The combined `$userInfo`, `$host`, and `$port` (e.g. as per [RFC 3986][]).

- `__toString() : string`
    - Recomposes the component values into a full URI string.

Implementations MAY sanitize component values (e.g. by applying [`trim()`][]).

Implementations MAY validate component values; the implementation MUST throw _LogicException_ (or an extension thereof) when the component value is invalid.

Notes:

- **These are property get hooks, not getter methods.** The property values are straightforward and require little-to-no logic around getting in most cases. Further, use of the `$queryParams` property looks more like idiomatic PHP; e.g., `$uri->queryParams['foo'] ?? 'bar'` and not `$uri->queryParams()['foo']` or `$uri->queryParams('foo', 'bar')`.

- **Unless specified otherwise, _Uri_ implementations are presumed conform to [`parse_url()`][] and related PHP functions.** Implementations MAY be marked with _Rfc3986Uri_, _Rfc3987Uri_, or _WhatwgUri_ to indicate they conform to those specifications instead.

### _MutableUri_

The _MutableUri_ interface extends _Uri_ to afford these property set hooks:

- `string $scheme { get; set; }`
- `string $host { get; set; }`
- `?int $port { get; set; }`
- `string $user { get; set; }`
- `string $password { get; set; }`
- `string $path { get; set; }`
- `string $query { get; set; }`
- `string $fragment { get; set; }`
- `QueryParamsArray $queryParams { get; set; }`

Implementations MUST keep `$queryParams` and `$query` in sync; if one is modified, the other MUST be modified accordingly.

Notes:

- **These are property set hooks, not setter methods.** The property values are straightforward and require little-to-no logic around setting in most cases.

- **There are no property set hooks for `$userInfo` or `$authority`.** Because these are combined from other property values, they are not modified directly.

### _ImmutableUri_

The _ImmutableUri_ interface extends _Uri_ to afford these methods:

- `withScheme(string $scheme) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$scheme` value.

- `withUser(string $user) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$user` value.

- `withPassword(string $password) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$password` value.

- `withHost(string $host) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$host` value.

- `withPort(?int $port) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$port` value.

- `withPath(string $path) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$path` value.

- `withQuery(string $query) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$query` value.

- `withFragment(string $fragment) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$fragment` value.

- `withQueryParams(QueryParamsArray $queryParams) : ImmutableUri`
    - Returns a new instance of the _ImmutableUri_ with the modified `$queryParams` value.

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
        string $user = '',
        string $password = '',
        string $host = '',
        ?int $port = null,
        string $path = '',
        string $query = '',
        string $fragment = '',
    ) : Uri
    ```

### _UriParser_

The _UriParser_ interface affords creating a new _Uri_ instance from a URI string:

- `parseUri(string|Stringable $uriString) : Uri`


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

[`parse_url()`]: https://php.net/parse_url
[`trim()`]: https://php.net/trim
[BCP 14]: https://www.rfc-editor.org/info/bcp14
[README-RESEARCH.md]: ./README-RESEARCH.md
[RFC 2119]: https://www.rfc-editor.org/rfc/rfc2119.txt
[RFC 3986]: https://datatracker.ietf.org/doc/html/rfc3986/
[RFC 3987]: https://datatracker.ietf.org/doc/html/rfc3987/
[RFC 8174]: https://www.rfc-editor.org/rfc/rfc8174.txt
[WHATWG-URL]: https://url.spec.whatwg.org/
