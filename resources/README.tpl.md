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

This package defines the following interfaces:

{{= list }}

{{= docs }}

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
