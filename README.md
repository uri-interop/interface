# Uri-Interop Standard Interface Package

[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)
[![PDS Composer Script Names](https://img.shields.io/badge/pds-composer--script--names-blue?style=flat-square)](https://github.com/php-pds/composer-script-names)

Uri-Interop provides an interoperable package of standard interfaces for
working with URIs in PHP 8.4 or later. It reflects, refines, and reconciles
the common practices identified within
[several pre-existing projects][README-RESEARCH.md].

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD",
"SHOULD NOT", "RECOMMENDED",  "MAY", and "OPTIONAL" in this document are to be
interpreted as described in [BCP 14][] ([RFC 2119][], [RFC 8174][]).

This package attempts to adhere to the [Package Development Standards](https://php-pds.com/) approach to [naming and versioning](https://php-pds.com/#naming-and-versioning).

## Interfaces

Uri-Interop defines the following interfaces:

- [_UriStruct_][] affords reading of URI component values and recomposing them into a string.

- [_MutableUriStruct_][] extends [_UriStruct_][] to afford direct modification of component values via property set hooks.

- [_ImmutableUriStruct_][] extends [_UriStruct_][] to afford immutable modification of component values via "with" methods.

- [_UriStructFactory_][] affords creating a new [_UriStruct_][] instance from parsed component values.

- [_UriStructNormalizer_][] affords creating a [_UriStruct_][] instance with [normalized component values][].

- [_UriStructResolver_][] affords creating a new [_UriStruct_][] instance by resolving a relative URI reference against a base URI.

- [_UriStringParser_][] affords creating a new [_UriStruct_][] instance from a URI string.

- [_UriThrowable_][] is a marker interface that extends [_Throwable_][] to indicate an [_Exception_][] is URI-related.

- [_UriTypeAliases_][] provides custom PHPStan types to aid static analysis.

### _UriStruct_

[_UriStruct_][] affords reading of URI component values and
recomposing them into a string.

- Directives:

    - Implementations MAY sanitize component values (e.g. by applying
      [`trim()`][]).

    - Implementations MAY [normalize component values][].

    - Implementations MAY validate component values; implementations doing
      so MUST throw a [_UriThrowable_][] when a component value is invalid.

- Notes:

    - **These are property get hooks, not getter methods.** The property
      values are straightforward and require little-to-no logic around
      getting in most cases. Further, use of the `$queryParams` property
      looks more like idiomatic PHP; e.g., `$uri->queryParams['foo'] ?? 'bar'`
      and not `$uri->queryParams()['foo']` or
      `$uri->queryParams('foo', 'bar')`.

    - **Most component values are nullable.** This preserves the
      distinction between the state of a component that is present but
      empty (e.g. as by an empty string) and that of a component not being
      present at all (represented by `null`). Note that `$path` is always
      considered present (though it may be empty).

    - **The query component is a `composed_string`.** Emulating a form
      submission might require using form-url-encoded values, so the query
      component may be composed of form-url-encoded values or
      percent-encoded values.

#### _UriStruct_ Properties

- ```php
  public ?string $scheme { get; }
  ```
    - The scheme component value (e.g., `https` or `urn`); does not include
    the `:` separator.

    - Directives:

        - Implementations MUST report this value as `null` if the scheme
          component is not present.

- ```php
  public ?percent_encoded_string $username { get; }
  ```
    - The username component value.

    - Directives:

        - Implementations MUST report this value as `null` if the username
          component is not present.

- ```php
  public ?percent_encoded_string $password { get; }
  ```
    - The password component value.

    - Directives:

        - Implementations MUST report this value as `null` if the password
          component is not present.

- ```php
  public ?percent_composed_string $host { get; }
  ```
    - The host component value (e.g. `www.example.net`, `127.0.0.1`, `[::1]`,
    and so on).

    - Directives:

        - Implementations MUST report this value as `null` if the host
          component is not present.

- ```php
  public ?int $port { get; }
  ```
    - The port component value (e.g. `443`).

    - Directives:

        - Implementations MUST report this value as `null` if the port
          component is not present.

- ```php
  public percent_composed_string $path { get; }
  ```
    - The path component value (e.g. `/path/to/page.html`, `ietf:rfc:3986`,
    `username@example.net`, and so on).

- ```php
  public ?composed_string $query { get; }
  ```
    - The query component value (e.g. `foo=bar&baz=qux`); does not include
    the `?` separator.

    - Directives:

        - Implementations MUST report this value as `null` if the query
          component is not present.

- ```php
  public ?percent_composed_string $fragment { get; }
  ```
    - The fragment component value; does not include the `#` separator.

    - Directives:

        - Implementations MUST report this value as `null` if the fragment
          component is not present.

- ```php
  public ?query_params_array $queryParams { get; }
  ```
    - The query component value represented as an associative array.

    - Directives:

        - Implementations MUST report this value as `null` if the query
          component is not present.

- ```php
  public ?percent_composed_string $userinfo { get; }
  ```
    - The recomposed `$username` and `$password`; does not include the `@`
    separator.

    - Directives:

        - Implementations MUST report this value as `null` if both
          `$username` and `$password` are `null`.

- ```php
  public ?percent_composed_string $authority { get; }
  ```
    - The recomposed `$userinfo`, `$host`, and `$port`; does not include the
    `//` separator.

    - Directives:

        - Implementations MUST report this value as `null` if `$userinfo`,
          `$host`, and `$port` are all `null`.

#### _UriStruct_ Methods

- ```php
  public function __toString() : composed_string;
  ```
    - Composes the component values into a full URI string.

### _MutableUriStruct_

[_MutableUriStruct_][] extends [_UriStruct_][] to afford direct
modification of component values via property set hooks.

- Directives:

    - Implementations MUST keep `$query` and `$queryParams` in sync; if
      one is modified, the other MUST be modified accordingly.

- Notes:

    - **These are property set hooks, not setter methods.** The property
      values are straightforward and require little-to-no logic around
      setting in most cases.

    - **There are no property set hooks for `$userinfo` or `$authority`.**
      Because these are combined from other component values, they are not
      modified directly.

#### _MutableUriStruct_ Properties

- ```php
  public ?string $scheme { get; set; }
  ```
    - The scheme component value (e.g., `https` or `urn`); does not include
    the `:` separator.

    - Directives:

        - Implementations MUST report this value as `null` if the scheme
          component is not present.

- ```php
  public ?percent_encoded_string $username { get; set; }
  ```
    - The username component value.

    - Directives:

        - Implementations MUST report this value as `null` if the username
          component is not present.

- ```php
  public ?percent_encoded_string $password { get; set; }
  ```
    - The password component value.

    - Directives:

        - Implementations MUST report this value as `null` if the password
          component is not present.

- ```php
  public ?percent_composed_string $host { get; set; }
  ```
    - The host component value (e.g. `www.example.net`, `127.0.0.1`, `[::1]`,
    and so on).

    - Directives:

        - Implementations MUST report this value as `null` if the host
          component is not present.

- ```php
  public ?int $port { get; set; }
  ```
    - The port component value (e.g. `443`).

    - Directives:

        - Implementations MUST report this value as `null` if the port
          component is not present.

- ```php
  public percent_composed_string $path { get; set; }
  ```
    - The path component value (e.g. `/path/to/page.html`, `ietf:rfc:3986`,
    `username@example.net`, and so on).

- ```php
  public ?composed_string $query { get; set; }
  ```
    - The query component value (e.g. `foo=bar&baz=qux`); does not include
    the `?` separator.

    - Directives:

        - Implementations MUST report this value as `null` if the query
          component is not present.

- ```php
  public ?percent_composed_string $fragment { get; set; }
  ```
    - The fragment component value; does not include the `#` separator.

    - Directives:

        - Implementations MUST report this value as `null` if the fragment
          component is not present.

- ```php
  public ?query_params_array $queryParams { get; set; }
  ```
    - The query component value represented as an associative array.

    - Directives:

        - Implementations MUST report this value as `null` if the query
          component is not present.

### _ImmutableUriStruct_

[_ImmutableUriStruct_][] extends [_UriStruct_][] to afford immutable
modification of component values via "with" methods.

- Notes:

    - **There are no methods for `withUserInfo()` or `withAuthority()`.**
      Because these are combined from other property values, they are not
      modified directly.

#### _ImmutableUriStruct_ Methods

- ```php
  public function withScheme(?string $scheme) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$scheme` value.

- ```php
  public function withUsername(
      ?percent_encoded_string $username,
  ) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$username` value.

- ```php
  public function withPassword(
      ?percent_encoded_string $password,
  ) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$password` value.

- ```php
  public function withHost(?percent_composed_string $host) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$host` value.

- ```php
  public function withPort(?int $port) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$port` value.

- ```php
  public function withPath(percent_composed_string $path) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$path` value.

- ```php
  public function withQuery(?composed_string $query) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$query` value.

    - Directives:

        - Implementations MUST keep `$query` and `$queryParams` in sync; if
          one is modified, the other MUST be modified accordingly.

- ```php
  public function withFragment(
      ?percent_composed_string $fragment,
  ) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$fragment` value.

- ```php
  public function withQueryParams(
      ?query_params_array $queryParams,
  ) : ImmutableUriStruct;
  ```
    - Returns a new instance of the [_ImmutableUriStruct_][] with the
    modified `$queryParams` value.

    - Directives:

        - Implementations MUST keep `$query` and `$queryParams` in sync; if
          one is modified, the other MUST be modified accordingly.

### _UriStructFactory_

[_UriStructFactory_][] affords creating a new [_UriStruct_][] instance
from parsed component values.

#### _UriStructFactory_ Methods

- ```php
  public function newUri(
      ?string $scheme = null,
      ?percent_encoded_string $username = null,
      ?percent_encoded_string $password = null,
      ?percent_composed_string $host = null,
      ?int $port = null,
      percent_composed_string $path = '',
      ?composed_string $query = null,
      ?percent_composed_string $fragment = null,
  ) : UriStruct;
  ```
    - Creates a new [_UriStruct_][] instance from the given component values.

### _UriStructNormalizer_

[_UriStructNormalizer_][] affords creating a [_UriStruct_][] instance
with [normalized component values][].

#### _UriStructNormalizer_ Methods

- ```php
  public function normalizeUri(UriStruct $uri) : UriStruct;
  ```
    - Returns a new [_UriStruct_][] instance with normalized component
    values.

    - Directives:

        - Implementations MUST apply [syntax-based normalization][] and MAY
          apply one or more additional normalizations (e.g.
          [scheme-based normalization][] or
          [protocol-based normalization][]).

        - Implementations MUST return a new instance of [_UriStruct_][].

### _UriStructResolver_

[_UriStructResolver_][] affords creating a new [_UriStruct_][] instance
by resolving a relative URI reference against a base URI.

#### _UriStructResolver_ Methods

- ```php
  public function resolveUri(UriStruct $base, UriStruct $relative) : UriStruct;
  ```
    - Returns a new [_UriStruct_][] instance representing `$relative`
    resolved against `$base`.

    - Directives:

        - Implementations MUST apply the algorithm described in
          [RFC 3986 Relative Resolution][].

        - Implementations MUST return a new instance of [_UriStruct_][].

        - Implementations MAY [normalize component values][] in the
          returned instance (e.g. by applying [syntax-based normalization][],
          [scheme-based normalization][], [protocol-based normalization][],
          etc.).

### _UriStringParser_

[_UriStringParser_][] affords creating a new [_UriStruct_][] instance
from a URI string.

- Directives:

    - Implementations SHOULD use the [RFC 3986 parsing algorithm][].

- Notes:

    - **The parser returns a new [_UriStruct_][] instance instead of an
      array of component values.** This reduces the number of steps
      involved in creating a new instance.

    - **The native [`parse_url()`][] PHP function is not strictly
      [RFC 3986][] compliant.** Using [`parse_url()`][] may be fine for
      many cases, but implementations should consider using the
      [RFC 3986][]-compliant approach instead.

#### _UriStringParser_ Methods

- ```php
  public function parseUri(string|Stringable $uriString) : UriStruct;
  ```
    - Returns a new [_UriStruct_][] instance parsed from the given URI
    string.

### _UriThrowable_

[_UriThrowable_][] is a marker interface that extends [_Throwable_][] to
indicate an [_Exception_][] is URI-related.

It adds no class members.

### _UriTypeAliases_

[_UriTypeAliases_][] provides custom PHPStan types to aid static analysis.

- `composed_string`
    - A concatenation of `encoded_string`s with component-appropriate
      `string` delimiters.

- `decoded_string`
    - The result of decoding an `encoded_string`.

- `encoded_string`
    - A `formurl_encoded_string` or `percent_encoded_string`.

- `formurl_composed_string`
    - A concatenation of `formurl_encoded_string`s with component-appropriate
      `string` delimiters.

- `formurl_encoded_string`
    - An `application/x-www-form-urlencoded` string, with `+` for the space
      character.

- ```
  parse_url_array array{
      scheme?:string,
      user?:string,
      pass?:string,
      host?:string,
      port?:?int,
      path?:string,
      query?:string,
      fragment?:string
  }
  ```
    - The array return from [`parse_url()`][].

- `percent_composed_string`
    - A concatenation of `percent_encoded_string`s with component-appropriate
      `string` delimiters.

- `percent_encoded_string`
    - A percent-encoded string, with `%20` for the space character.

- `query_params_array`
    - An associative array of up to 16 dimensions with `decoded_string` keys
      and `decoded_string` values.

- Notes:

    - **Native PHP functions will suffice for the type aliases.**
      Implementations may provide their own alternative functionality.

        - [`http_build_query()`][] with `encoding_type: PHP_QUERY_1738` will
          encode each space character as `+`, returning a
          `formurl_encoded_string`.

        - [`http_build_query()`][] with `encoding_type: PHP_QUERY_3986` will
          encode each space character as `%20`, returning a
          `percent_encoded_string`.

        - [`parse_str()`][] will decode both `+` and `%20` to a space
          character, returning a `query_params_array`.

        - [`rawurlencode()`][] will encode each space character as `%20`,
          returning a `percent_encoded_string`.

        - [`urldecode()`][] will decode both `+` and `%20` to a space
          character, returning a `decoded_string`.

        - [`urlencode()`][] will encode each space character as `+`,
          returning a `formurl_encoded_string`.

    - **The `*_[00-0F]` types are to enable limited recursion.** PHPStan
      does not handle recursive type aliases, so `query_params_array`
      cannot ever refer back to itself. As a result, that type alias
      refers to the `*_[00-0F]` types to enable recursion to 16
      dimensions. Consumers need not use these recursion-enabling type
      aliases.

## Implementations

Implementations advertised as readonly or immutable MUST be deeply readonly or immutable; they MUST NOT encapsulate any references, resources, mutable objects, objects or arrays encapsulating references or resources or mutable objects, and so on.

Implementations MAY define additional class members not defined in these interfaces; implementations advertised as readonly or immutable MUST make those additional class members deeply readonly or immutable.

Notes:

- **Reflection does not invalidate advertisements of readonly or immutable implementations.** The ability of a consumer to use Reflection to mutate an implementation advertised as readonly or immutable does not constitute a failure to comply with Uri-Interop.

- **Reference implementations** are available at <https://github.com/uri-interop/impl>.

## Q & A

### Why `$username` and not `$user`?

Among the researched projects, `$user` was the more common property name. Earlier drafts honored the majority. However, for symmetry with `$password` and `$userinfo`, reviewers found `$username` more suitable. The fact that [WHATWG-URL][] specifies `username` strengthened that preference.

### Why `$password` and not `$pass`?

Among the researched projects, `$password` was the more common property name.

### Why `$userinfo` (lower case) and not `$userInfo` (camel case)?

Among the researched projects, most used camel-casing for this property and/or its associated methods, rather than all lower case. Earlier drafts honored this majority usage. However, for symmetry with `$username` and `$password`, reviewers found `$userinfo` more suitable.

### Why is RFC 3987 not included?

Earlier drafts of these standard interfaces included an [RFC 3987][] marker interface for IRIs, in an attempt to unify IRI and URI handling. In the end it was removed:

1. There are too few IRI implementations to draw from.
2. Tooling around percent-encoding for UCS characters is practically nonexistent.
3. Percent-encoding strategies around ASCII-only URIs as vs UCS-allowed IRIs were difficult to typehint sensibly.

Despite this, [RFC 3987][] projects do have some overlap with URIs, and thus continue to inform Uri-Interop.

### Why is WHATWG-URL not included?

Earlier drafts of these standard interfaces included a [WHATWG-URL][] marker. However, there are enough differences between [WHATWG-URL][] and the [RFC 3986][]-like behaviors of the researched projects to warrant exclusion from this standard.

Despite this, [WHATWG-URL][] does have some overlap with [RFC 3986][], and thus continues to inform Uri-Interop.

### Why is there no `UriStruct::normalize()` interface method?

Although a [_UriStructNormalizer_][] is provided to afford normalizing any [_UriStruct_][], there is no interface that affords something like a `normalize()` method directly on a [_UriStruct_][]. Reviewers preferred being able to specify normalization logic independent from any particular [_UriStruct_][] implementation, especially when normalizing URIs from different implementors to compare them for equivalence.

### Why is there no `UriStruct::resolve()` interface method?

Although a [_UriStructResolver_][] is provided to afford resolving relative URI references, there is no interface that affords something like a `resolve()` method directly on a [_UriStruct_][]. As with normalization, reviewers preferred being able to specify resolution logic independent from any particular [_UriStruct_][] implementation.

* * *

[_Exception_]: https://php.net/Exception
[_ImmutableUriStruct_]: #immutableuristruct
[_MutableUriStruct_]: #mutableuristruct
[_Throwable_]: https://php.net/Throwable
[_UriStringParser_]: #uristringparser
[_UriStruct_]: #uristruct
[_UriStructFactory_]: #uristructfactory
[_UriStructNormalizer_]: #uristructnormalizer
[_UriStructResolver_]: #uristructresolver
[_UriThrowable_]: #urithrowable
[_UriTypeAliases_]: #uritypealiases
[`http_build_query()`]: https://php.net/http_build_query
[`parse_str()`]: https://php.net/parse_str
[`parse_url()`]: https://php.net/parse_url
[`rawurlencode()`]: https://php.net/rawurlencode
[`trim()`]: https://php.net/trim
[`urldecode()`]: https://php.net/urldecode
[`urlencode()`]: https://php.net/urlencode
[BCP 14]: https://www.rfc-editor.org/info/bcp14
[normalize component values]: https://datatracker.ietf.org/doc/html/rfc3986/#section-6
[normalized component values]: https://datatracker.ietf.org/doc/html/rfc3986/#section-6
[protocol-based normalization]: https://datatracker.ietf.org/doc/html/rfc3986/#section-6.2.4
[README-RESEARCH.md]: ./README-RESEARCH.md
[RFC 2119]: https://datatracker.ietf.org/doc/html/rfc2119
[RFC 3986 parsing algorithm]: https://datatracker.ietf.org/doc/html/rfc3986/#appendix-B
[RFC 3986 Relative Resolution]: https://datatracker.ietf.org/doc/html/rfc3986/#section-5.2
[RFC 3986]: https://datatracker.ietf.org/doc/html/rfc3986/
[RFC 3987]: https://datatracker.ietf.org/doc/html/rfc3987/
[RFC 8174]: https://datatracker.ietf.org/doc/html/rfc8174
[scheme-based normalization]: https://datatracker.ietf.org/doc/html/rfc3986/#section-6.2.3
[syntax-based normalization]: https://datatracker.ietf.org/doc/html/rfc3986/#section-6.2.2
[WHATWG-URL]: https://url.spec.whatwg.org/
