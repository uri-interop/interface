# Uri-Interop Interface Package

[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)
[![PDS Composer Script Names](https://img.shields.io/badge/pds-composer--script--names-blue?style=flat-square)](https://github.com/php-pds/composer-script-names)

The Uri-Interop project publishes an interoperable set of URI interfaces for PHP 8.4+. It reflects, refines, and reconciles the common practices identified within [several pre-existing projects][README-RESEARCH.md].

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED",  "MAY", and "OPTIONAL" in this document are to be interpreted as described in [BCP 14][] ([RFC 2119][], [RFC 8174][]).

This package attempts to adhere to the [Package Development Standards](https://php-pds.com/) approach to [naming and versioning](https://php-pds.com/#naming-and-versioning).

## Interfaces

Uri-Interop defines separate interfaces to afford reading and modifying the URI components described by [RFC 3896][]:

- [_Uri_](#uri) affords reading of the URI component values, and the URI as a whole.
- [_MutableUri_](#mutableuri) extends _Uri_ to afford direct modification of component values.
- [_ImmutableUri_](#immutableuri) extends _Uri_ to afford immutable modification of component values.
- [_UriFactory_](#urifactory) affords creating a new URI instance.

### _Uri_

The _Uri_ interface affords readability of URI components using these properties and methods:

- `string $scheme { get; }`
    - Corresponds to the `scheme` key from [`parse_url()`][].

- `string $host { get; }`
    - Corresponds to the `host` key from [`parse_url()`][].

- `?int $port { get; }`
    - Corresponds to the `port` key from [`parse_url()`][].

- `string $user { get; }`
    - Corresponds to the `user` key from [`parse_url()`][].

- `string $password { get; }`
    - Corresponds to the `pass` key from [`parse_url()`][].

- `string $path { get; }`
    - Corresponds to the `path` key from [`parse_url()`][].

- `string $query { get; }`
    - Corresponds to the `query` key from [`parse_url()`][].

- `string $fragment { get; }`
    - Corresponds to the `fragment` key from [`parse_url()`][].

- `QueryParamsArray $queryParams { get; }`
    - Corresponds to a decoded form of `$query` (e.g., as if by [`parse_str()`][]).

- `string $userInfo { get; }`
    - The combined `$user` and `$password` as specified by <https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2.1>.

- `string $authority { get; }`
    - The combined `$userInfo`, `$host`, and `$port` as specified by <https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2>.

- `__toString() : string`
    - Returns the entire URI specified by <https://datatracker.ietf.org/doc/html/rfc3986/#section-3>.

Implementations MAY sanitize component values (e.g. by applying [`trim()`][]).

Implementations MAY validate component values; the implementation MUST throw _LogicException_ (or an extension thereof) when the component value is invalid.

The _Uri_ interface also defines this custom PHPStan type to aid static analysis:

- `QueryParamsArray: string[]|QueryParamsArray`
    - Recursively `string[]` to 16 keys deep.

Notes:

- **These are property get hooks, not getter methods.** The property values are straightforward and require little-to-no logic around getting in most cases. Further, use of the `$queryParams` property looks more like idiomatic PHP; e.g., `$uri->queryParams['foo'] ?? 'bar'` and not `$uri->queryParams()['foo']` or `$uri->queryParams('foo', 'bar')`.

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

### _UriFactory_

The _UriFactory_ interface affords creating a new _Uri_ instance from various source specifications:

- `newUri(null|string|Stringable|ParsedUrlArray|Uri $spec = null) : Uri`
    - When `$spec` is `null`, implementations MUST create and return a new default _Uri_ instance.
    - When `$spec` is a string or _Stringable_, implementations MUST parse it (e.g. via [`parse_url()`][]) and use those parsed values to create and return a new _Uri_ instance.
    - When `$spec` is a `ParsedUrlArray`, implementations MUST use those parsed values to create and return a new _Uri_ instance.
    - When `$spec` is a _Uri_, implementations MUST use its properties to create and return a new _Uri_ instance.

Implementations MUST throw _LogicException_ (or an extension thereof) if the `$spec` is not usable for creating a _Uri_ (e.g., invalid or cannot be parsed).

The _UriFactory_ interface also defines this custom PHPStan type to aid static analysis:

- `ParsedUrlArray` corresponds to the return value of [`parse_url()`][]:

    ```
    array{
        scheme?: string,
        port?: int<0, 65535>,
        user?: string,
        pass?: string,
        path?: string,
        query?: string,
        fragment?: string
    }
    ```

## Implementations

Implementations advertised as readonly or immutable MUST be deeply readonly or immutable; they MUST NOT encapsulate any references, resources, mutable objects, objects or arrays encapsulating references or resources or mutable objects, and so on.

Implementations MAY define additional properties and methods not defined in these interfaces; implementations advertised as readonly or immutable MUST make those additional elements deeply readonly or immutable.

Notes:

- **Reflection does not invalidate advertisements of readonly or immutable implementations.** The ability of a consumer to use Reflection to mutate an implementation advertised as readonly or immutable does not constitute a failure to comply with Uri-Interop.

- **Reference implementations** may be found at <https://github.com/uri-interop/impl>.

## Q & A

### Why `$user` and not `$username`?

Among the researched projects, `$user` was the more common property name.

### Why `$password` and not `$pass`?

Among the researched projects, `$password` was the more common property name. (This is the only deviation from the array returned by [`parse_url()`][]; all the other properties end up being the same as the keys in that array.)

### Why `$userInfo` and not `$userinfo`?

Among the researched projects, most used camel-casing for this property and/or its associated methods, rather than all lower case.

* * *

[`parse_url()`]: https://php.net/parse_url
[`trim()`]: https://php.net/trim
[BCP 14]: https://www.rfc-editor.org/info/bcp14
[README-RESEARCH.md]: ./README-RESEARCH.md
[RFC 2119]: https://www.rfc-editor.org/rfc/rfc2119.txt
[RFC 3896]: https://datatracker.ietf.org/doc/html/rfc3986/
[RFC 8174]: https://www.rfc-editor.org/rfc/rfc8174.txt
