# Change Log

## 1.0.0

First stable release.

## 1.0.0-beta4

- BC break: from resolveUri($relative, $base) to resolveUri ($base, $relative), based on a note from one reviewer who pointed out that the (very few) research examples uses that order

## 1.0.0-beta3

- The host component is now typed as a composed string, not an merely an encoded one.

## 1.0.0-beta2

- Implementation normalization requirements and recommendations.

- Resolution requirements and recommendations.

## 1.0.0-beta1

- Renamed interfaces from UriRecord to UriStruct, reducing ease-of-confusion with WHATWG-URL UrlRecord implementations.

- Introduced UriThrowable.

## 1.0.0-alpha3

Modifications from public and private review; extending public review period.

- Renamed interfaces from UriComponents to UriRecord, a la WHATWG-URL UrlRecord.

- Fixed query_params_array type alias.

- Added UriRecordNormalizer::normalizeUri().

- Added UriRecordResolver::resolveUri().

## 1.0.0-alpha2

Modifications from public and private review; extending public review period.

- Stricter type hinting
    - $path is no longer nullable (fixes #1)
    - all properties are now encoded, as vs some being encoded and some not

- Removed properties
    - $pathSegments

- Renamed properties and methods
    - $user -> $username
    - $userInfo -> $userinfo
    - withUser() -> withUsername()

- Updates to research
    - re-added rowbot/url (WHATWG-URL)
    - added ml/iri and rmccue/requests (IRI)

- Removed marker interfaces, concentrating only on URIs and not IRIs
    - Rfc3986Compliant
    - Rfc3987Compliant

- Renamed interfaces to ease implementation naming
    - Uri -> UriComponents
    - MutableUri -> MutableUriComponents
    - ImmutableUri -> ImmutableUriComponents
    - UriFactory -> UriComponentsFactory
    - UriParser -> UriStringParser

## 1.0.0-alpha1

Ready for public review.

The following changes are the result of private review:

- All Uri values are now nullable.

- Added $pathSegments property.

- Add a UriParser interface.

- UriFactory now works from parsed component values.

- PHPStan aliases are now in a UriTypeAliases interface.

- PHPStan aliases are now in snake_case to visually distinguish them from ClassNames.

- Removed WHATWG-URL considerations, and `rowbot` as a reference project.

## 1.0.0-dev1

Ready for private review.
