# Research

Uri-Interop is based on research including the following URI projects:

- [amphp/url](https://github.com/amphp/uri/blob/master/src/Uri.php) (amphp)
- [aura/uri](https://github.com/auraphp/Aura.Uri/blob/2.x/src/Url.php) (aura)
- [codeigniter4](https://github.com/codeigniter4/CodeIgniter4/blob/develop/system/HTTP/URI.php) (ci4)
- [codezero/php-url-builder](https://github.com/codezero-be/php-url-builder/blob/master/src/UrlBuilder.php) (codezero)
- [joomla/uri](https://github.com/joomla-framework/uri/blob/3.x-dev/src/AbstractUri.php) (joomla)
- [josantonius/url](https://github.com/josantonius/php-url/blob/main/src/Url.php) (josan)
- [juststeveking/uri-builder](https://github.com/JustSteveKing/uri-builder/blob/main/src/Uri.php) (justking)
- [laminas/laminas-uri](https://github.com/laminas/laminas-uri/blob/2.14.x/src/UriInterface.php) (laminas)
- [league/uri](https://github.com/thephpleague/uri/blob/master/Uri.php) (league)
- [nette/http](https://github.com/nette/http/blob/master/src/Http/Url.php) (nette)
- [opis/uri](https://github.com/opis/uri/blob/master/src/Uri.php) (opis)
- [pear/net_url2](https://github.com/pear/Net_URL2/blob/master/Net/URL2.php) (pear)
- [psr/http-message](https://github.com/php-fig/http-message/blob/master/src/UriInterface.php) (psr)
- [xp-forge/uri](https://github.com/xp-forge/uri/blob/master/src/main/php/util/URI.class.php) (xpforge)
- [zenstruck/uri](https://github.com/zenstruck/uri/blob/2.x/src/Uri.php) (zenstr)

These IRI and WHATWG-URL projects are included as well, for their overlap with URI projects:

- [ml/iri](https://github.com/lanthaler/IRI) (mliri)
- [rmccue/requests](https://github.com/WordPress/Requests/blob/develop/src/Iri.php) (rmccue)
- [rowbot/url](https://github.com/TRowbotham/URL-Parser/blob/master/src/URL.php) (rowbot)

Many other projects were considered but did not have an obviously relevant implementation.

## Mutability

The projects offer varying levels of mutability:

|          | Readonly | Immutable | Mutable |
| -------- | -------- | --------- | ------- |
| amphp    | X        |           |         |
| aura     |          |           | X       |
| ci4      |          |           | X       |
| codezero |          |           | X       |
| joomla   |          | X         | X       |
| josan    | X        |           |         |
| justking |          |           | X       |
| laminas  |          |           | X       |
| league   |          | X         |         |
| mliri    | X        |           |         |
| nette    |          | X         | X       |
| opis     | X        |           |         |
| pear     |          |           | X       |
| psr      |          | X         |         |
| rmccue   |          |           | X       |
| rowbot   |          |           | X       |
| xpforge  | X        |           |         |
| zenstr   |          | X         |         |

Note that Joomla and Nette offer both mutable and immutable implementations.

## Basic URI Components

All of the projects provide a means to retrieve these URI components, either via a getter method or a property:

- `scheme`
- `host`
- `port`
- `path`
- `query` (as a string)
- `fragment`

### User/Username

Most projects provide access to a `user`or `username` component, either via a getter method or a property, but some do not provide it at all:

|          | `user` | `username` | none |
| -------- | ------ | ---------- | ---- |
| amphp    | X      |            |      |
| aura     | X      |            |      |
| ci4      |        |            | X    |
| codezero | X      |            |      |
| joomla   | X      |            |      |
| josan    |        | X          |      |
| justking |        |            | X    |
| laminas  | X      |            |      |
| league   |        | X          |      |
| mliri    |        |            | X    |
| nette    | X      |            |      |
| opis     | X      |            |      |
| pear     | X      |            |      |
| psr      |        |            | X    |
| rmccue   |        |            | X    |
| rowbot   |        | X          |      |
| xpforge  |        | X          |      |
| zenstr   |        | X          |      |

### Pass/Password

Most projects provide acccess to a `pass` or `password` component, either via a getter method or a property, but some do not provide it at all:

|          | `pass` | `password` | none |
| -------- | ------ | ---------- | ---- |
| amphp    | X      |            |      |
| aura     | X      |            |      |
| ci4      |        | X          |      |
| codezero | X      |            |      |
| joomla   | X      |            |      |
| josan    |        | X          |      |
| justking |        |            | X    |
| laminas  |        | X          |      |
| league   |        | X          |      |
| mliri    |        |            | X    |
| nette    |        | X          |      |
| opis     | X      |            |      |
| pear     |        | X          |      |
| psr      |        |            | X    |
| rmccue   |        |            | X    |
| rowbot   |        | X          |      |
| xpforge  |        | X          |      |
| zenstr   |        | X          |      |

### Component Types

The `port` value is always an integer, while the other components are always strings.

These projects allow the following components to be nullable:

|          | Scheme | User | Password | Host | Port | Path | Query | Fragment |
| -------- | ------ | ---- | -------- | ---- | ---- | ---- | ----- | -------- |
| amphp    |        |      |          |      | X    |      |       |          |
| aura     |        |      |          |      | X    |      |       |          |
| ci4      |        |      |          |      | X    |      |       |          |
| codezero |        |      |          |      | X    |      |       |          |
| joomla   |        |      |          |      | X    |      |       |          |
| josan    |        |      |          |      | X    |      |       |          |
| justking |        |      |          |      | X    |      |       |          |
| laminas  | X      | X    | X        | X    | X    | X    | X     | X        |
| league   | X      | X    | X        | X    | X    |      | X     | X        |
| mliri    | X      | X    | X        | X    | X    |      | X     | X        |
| nette    |        |      |          |      | X    |      |       |          |
| opis     | X      | X    | X        | X    | X    | X    | X     | X        |
| pear (1) | X      | X    | X        | X    | X    |      | X     | X        |
| psr      |        |      | X        |      | X    |      |       |          |
| rmccue   | X      | X    | X        | X    | X    |      | X     | X        |
| rowbot   |        |      |          |      | X    |      |       |          |
| xpforge  |        | X    | X        | X    | X    |      |       |          |
| zenstr   |        | X    | X        |      | X    |      |       | X        |

(1) Pear uses `false` instead of `null` to the same effect.

### Component Encoding

Almost all projects retain all basic URI component values in their encoded form. Only these projects retain some components in their decoded form:

|          | Decoded                            |
| -------- | ---------------------------------- |
| aura     | all                                |
| nette    | host, username, password, fragment |
| zenstr   | fragment                           |


## Added URI Components

The projects sometimes offer additional or computed URI components.

### Query As Array

These projects offer the query string decoded into arrays of strings, either via a getter method or a property:

|          | Query (as array) |
| -------- | ---------------- |
| amphp    | X                |
| aura     | X                |
| ci4      |                  |
| codezero | X                |
| joomla   | X                |
| josan    | X                |
| justking | X                |
| laminas  | X                |
| league   |                  |
| mliri    |                  |
| nette    | X                |
| opis     |                  |
| pear     | X                |
| psr      |                  |
| rmccue   |                  |
| rowbot   |                  |
| xpforge  | X                |
| zenstr   | X                |

When the query is offered as an array, it is under various terms, with variations on "params" and "parameters" being the most common:

|          | Method/Property                | query | array | params | parameters | variables |
| -------- | ------------------------------ | ----- | ----- | ------ | ---------- | --------- |
| amphp    | getAllQueryParameters()        |       |       |        | X          |           |
| aura     | $query                         | X     |       |        |            |           |
| codezero | getQuery()                     | X     |       |        |            |           |
| joomla   | getQuery()                     | X     |       |        |            |           |
| josan    | $parameters                    |       |       |        | X          |           |
| justking | queryParams()                  |       |       | X      |            |           |
| laminas  | getQueryAsArray()              |       | X     |        |            |           |
| nette    | getQueryParameters()           |       |       |        | X          |           |
| pear     | getQueryVariables()            |       |       |        |            | X         |
| xpforge  | params()                       |       |       | X      |            |           |
| zenstr   | $parameters, withQueryParams() |       |       | X      | X          |           |

### Path As Array

These projects offer the path string decoded into an array (or equivalent) of segment strings, either via a getter method or a property:

|          | Path (as array)              |
| -------- | ---------------------------- |
| amphp    |                              |
| aura     | _Path_ extends _ArrayObject_ |
| ci4      | `URI::getSegments()`         |
| codezero | `UrlBuilder::getSlugs()`     |
| joomla   |                              |
| josan    | `Url::$segments`             |
| justking |                              |
| laminas  |                              |
| league   |                              |
| mliri    |                              |
| nette    |                              |
| opis     |                              |
| pear     |                              |
| psr      |                              |
| rmccue   |                              |
| rowbot   |                              |
| xpforge  |                              |
| zenstr   | `Path::segments()`           |

### User Information Component

These projects offer a string of the combined username and password portions of the URI, [per RFC 3986](https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2.1), either via a getter method or a property:

|          | User Information |
| -------- | ---------------- |
| amphp    |                  |
| aura     |                  |
| ci4      | X                |
| codezero |                  |
| joomla   |                  |
| josan    |                  |
| justking |                  |
| laminas  | X                |
| league   | X                |
| mliri    | X                |
| nette    |                  |
| opis     | X                |
| pear     | X                |
| psr      | X                |
| rmccue   | X                |
| rowbot   |                  |
| xpforge  |                  |
| zenstr   | X                |

When the user information component is offered, the "info" portion of the term is capitalized differently in different projects:

|         | Info | info |
| ------- | ---- | ---- |
| ci4     |      | X    |
| laminas | X    |      |
| league  | X    |      |
| mliri   | X    |      |
| opis    | X    |      |
| pear    |      | X    |
| psr     |      | X    |
| zenstr  | X    |      |

The ability to modify user information *per se* is present in few of the projects; the method signature usually separates the user name from the password. (It is more common to modify the user name and password independently.)

|         | Method                                                                              |
| ------- | ----------------------------------------------------------------------------------- |
| laminas | `setUserInfo($userinfo)`                                                            |
| league  | `withUserInfo(?string $user, ?string $password = null)`                             |
| pear    | `setUserinfo($userinfo, $password = false)`                                         |
| psr     | `withUserInfo(string $user, ?string $password = null)`                              |
| rmccue  | `set_userinfo(string $userinfo)`                             |

### Authority Component

The following projects offer a combined string of the username, password, host, and port portions of the URI, [per the RFC](https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2), either via a getter method or a property.

|          | Authority |
| -------- | --------- |
| amphp    | X         |
| aura     |           |
| ci4      | X         |
| codezero |           |
| joomla   |           |
| josan    | X         |
| justking |           |
| laminas  |           |
| league   | X         |
| mliri    | X         |
| nette    |           |
| opis     | X         |
| pear     | X         |
| psr      | X         |
| rmccue   | X         |
| rowbot   |           |
| xpforge  | X         |
| zenstr   | X         |

When the authority component is offered, the term "authority" is always used.

The ability to modify the authority value *per se* is present in only one project (rmccue). The other projects all opt to modify the sub-components of the authority independently.

## Parsing

### Approaches

These projects use these approaches to parsing URL component values.

|          | parse_url() | RFC 3986 | RFC 3987 | None |
| -------- | ----------- | -------- | -------- | ---- |
| amphp    | X           |          |          |      |
| aura     | X           |          |          |      |
| ci4      | X           |          |          |      |
| codezero | X           |          |          |      |
| joomla   | X (1)       |          |          |      |
| josan    | X           |          |          |      |
| justking | X           |          |          |      |
| laminas  |             | X        |          |      |
| league   |             | X        | X        |      |
| mliri    |             | X        | X        |      |
| nette    | X (2)       |          |          |      |
| opis     |             | X        |          |      |
| pear     |             | X        |          |      |
| psr      |             |          |          | X    |
| rmccue   |             | X        | X        |      |
| xpforge  |             | X        |          |      |
| zenstr   | X           |          |          |      |

1. Joomla handles UTF-8 characters while parsing.
2. Nette applies rawurldecode() to the host, user, password, and fragment.

### Public Methods

These projects offer a public method to parse URI strings to their component values (often just a constructor):

|          | Parse into component values                                                                          |
| -------- | ---------------------------------------------------------------------------------------------------- |
| amphp    | `Uri::__construct(string $uri)`                                                                      |
| aura     | `UrlFactory::newInstance(string $spec) : Url`                                                        |
| ci4      | `Uri::__construct(?string $uri = null)`                                                              |
| codezero | `Uri::setURI(?string $uri = null) : void`                                                            |
| joomla   | `Uri::__construct(?string $uri = null)`                                                              |
| josan    | `Url::__construct(?string $url = null)`                                                              |
| justking | `Uri::fromString(string $uri) : Uri`                                                                 |
| laminas  | `Uri::parse(string $uri) : Uri`                                                                      |
| league   | `Uri::new(Stringable\|string $uri = '') : Uri`                                                       |
| mliri    | `IRI::__construct(null\|string\|IRI $iri = null)`                                                    |
| nette    | `Url::__construct(string\|Url\|UrlImmutable\|null $url = null)`                                      |
| opis     | `Uri::create(string $uri, bool $normalize = false) : ?Uri`                                           |
| pear     | `Net_URL2::__construct(string $url, array $options = array())`                                       |
| psr      | `UriFactoryInterface::createUri(string $uri = '') : UriInterface`                                    |
| rowbot   | `BasicURLParser::parse(USVStringInterface $input) : UrlRecord\|false`                                |
| xpforge  | `Uri::__construct(string\|Creation $base, ?string $relative = null)`                                 |
| zenstr   | `ParsedUri::new(ParsedUri\|string\|null $what = null) : ParsedUri`                                   |

## Normalizing

These projects offer a public method to normalize URI components (cf. <https://datatracker.ietf.org/doc/html/rfc3986/#section-6.2.2>):

|          | Signature                                             | Notes                               |
| -------- | ----------------------------------------------------- | ----------------------------------- |
| amphp    | `Uri::normalize() : string`                           |                                     |
| laminas  | `Uri::normalize() : Uri`                              | Mutates `$this`, returns `$this`    |
| opis     | `Uri::normalizeComponents(array $components) : array` |                                     |
| pear     | `Net_URL2::normalize() : void`                        | Mutates `$this`                     |
| zenstr   | `ParsedUri::normalize()`                              | Clones `$this` without modification |

## Resolving

These projects offer a public method to resolve a relative URI reference (cf. <https://datatracker.ietf.org/doc/html/rfc3986/#section-5>) -- though the base URI is sometime the instance being called, and sometimes the argument being passed:

|           | Signature                                                                | Base URI   | Notes                           |
| --------- |------------------------------------------------------------------------- | ---------- | ------------------------------- |
| amphp     | `Uri::resolve(string $toResolve) : Uri`                                  | `$this`    | Returns a new instance          |
| ci4       | `URI::resolveRelativeURI(string $uri) : URI`                             | `$this`    | Returns a new instance          |
| laminas   | `Uri::resolve(Uri\|string $baseUri) : Uri`                               | `$baseUri` | Mutates $this, returns $this    |
| league    | `BaseUri::resolve(Stringable\|string $uri) : static`                     | `$this`    | Returns a new instance          |
| mliri     | `IRI::resolve(self\|string $relativeReference) : self`                   | `$this`    | Returns a new instance          |
| nette     | `UrlImmutable::resolve(string $reference) : self`                        | `$this`    | Returns a new instance          |
| opis      | `Uri::resolve($base, bool $normalize = false) : self`                    | `$base`    | Returns $this or a new instance |
| pear      | `Net_URL2::resolve(Net_URL2\|string $reference) : self`                  | `$this`    | Returns a new instance          |
| rmccue    | `Iri::absolutize(IRI\|string $base, IRI\|string $relative) : false\|Iri` | `$base`    | Returns a new instance          |
| xp-forge  | `URI::resolve(string\|self $arg) : self`                                 | `$this`    | Returns $this or a new instance |


## Exceptions

The projects throw these PHP _Exception_ types when parsing a URI or validating its components:

|          | Failure to parse           | Failure to validate        | Custom _Exception_ classes                                                   |
| -------- | -------------------------- | -------------------------- | ---------------------------------------------------------------------------- |
| amphp    | _Exception_                | _Exception_                | _Amp\Uri\InvalidUriException_                                                |
| aura     |                            |                            |                                                                              |
| ci4      | _RuntimeException_         | _RuntimeException_         | _CodeIgniter\HTTP\Exceptions\HTTPException_                                  |
| codezero |                            |                            |                                                                              |
| joomla   | _RuntimeException_         |                            |                                                                              |
| josan    |                            |                            |                                                                              |
| justking | _InvalidArgumentException_ | _InvalidArgumentException_ |                                                                              |
| laminas  | _InvalidArgumentException_ | _InvalidArgumentException_ | _Laminas\Uri\Exception\\{InvalidArgumentException, InvalidUriPartException_} |
| league   |                            | _InvalidArgumentException_ | _League\Uri\Exceptions\SyntaxError_                                          |
| mliri    | _InvalidArgumentException_ |                            |                                                                              |
| nette    | _InvalidArgumentException_ |                            |                                                                              |
| opis     |                            |                            |                                                                              |
| pear     |                            |                            |                                                                              |
| psr      |                            | _InvalidArgumentException_ |                                                                              |
| rmccue   | _InvalidArgumentException_ |                            |                                                                              |
| rowbot   |                            |                            |                                                                              |
| xpforge  | _Exception_                | _Exception_                | _lang\\{FormatException, IllegalStateException}_                             |
| zenstr   | _InvalidArgumentException_ | _InvalidArgumentException_ |                                                                              |

* * *
