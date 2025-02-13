# Research

Uri-Interop is based on research including the following 16 projects:

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
- [rowbot/url](https://github.com/TRowbotham/URL-Parser/blob/master/src/URL.php) (rowbot)
- [xp-forge/uri](https://github.com/xp-forge/uri/blob/master/src/main/php/util/URI.class.php) (xpforge)
- [zenstruck/uri](https://github.com/zenstruck/uri/blob/2.x/src/Uri.php) (zenstr)

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
| nette    |          | X         | X       |
| opis     | X        |           |         |
| pear     |          |           | X       |
| psr      |          | X         |         |
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

Most projects provide access to a `user`(8) or `username` (5) component, either via a getter method or a property, but some do not provide it at all:

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
| nette    | X      |            |      |
| opis     | X      |            |      |
| pear     | X      |            |      |
| psr      |        |            | X    |
| rowbot   |        | X          |      |
| xpforge  |        | X          |      |
| zenstr   |        | X          |      |

### Pass/Password

Most projects provide acccess to a `pass` (5) or `password` (9) component, either via a getter method or a property, but some do not provide it at all:

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
| nette    |        | X          |      |
| opis     | X      |            |      |
| pear     |        | X          |      |
| psr      |        |            | X    |
| rowbot   |        | X          |      |
| xpforge  |        | X          |      |
| zenstr   |        | X          |      |

### Component Types

The `port` value is always an integer, while the other components are always strings. The projects allow these components to be nullable:

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
| nette    |        |      |          |      | X    |      |       |          |
| opis     | X      | X    | X        | X    | X    | X    | X     | X        |
| pear (1) | X      | X    | X        | X    | X    |      | X     | X        |
| psr      |        |      | X        |      | X    |      |       |          |
| rowbot   |        |      |          |      | X    |      |       |          |
| xpforge  |        | X    | X        | X    | X    |      |       |          |
| zenstr   |        | X    | X        |      | X    |      |       | X        |
| -------- | ------ | ---- | -------- | ---- | ---- | ---- | ----- | -------- |
| TOTALS   | 4      | 6    | 7        | 5    | 16   | 2    | 4     | 5        |

(1) Pear uses `false` instead of `null` to the same effect.

Aside from the `port`, there is no wide agreement on nullability, or even on which components should be nullable.

## Added URI Components

The projects sometimes offer additional or computed URI components.

### Query As Array

10 of the projects offer the query string decoded into arrays of strings, either via a getter method or a property:

|          | Query (as array) |
| -------- | ---------------- |
| amphp    | X                |
| aura     | X                |
| ci4      | X                |
| codezero | X                |
| joomla   | X                |
| josan    | X                |
| justking | X                |
| laminas  | X                |
| league   |                  |
| nette    | X                |
| opis     |                  |
| pear     | X                |
| psr      |                  |
| rowbot   |                  |
| xpforge  | X                |
| zenstr   | X                |

When the query is offered as an array, it is under various terms, with variations on "params" and "parameters" being the most common:

|          | Method/Property                | query | array | params | parameters | variables |
| -------- | ------------------------------ | ----- | ----- | ------ | ---------- | --------- |
| amphp    | getAllQueryParameters()        |       |       |        | X          |           |
| aura     | $query                         | X     |       |        |            |           |
| ci4      | getQueryParamsArray()          |       | X     |        |            |           |
| codezero | getQuery()                     | X     |       |        |            |           |
| joomla   | getQuery()                     | X     |       |        |            |           |
| josan    | $parameters                    |       |       |        | X          |           |
| justking | queryParams()                  |       |       | X      |            |           |
| laminas  | getQueryAsArray()              |       | X     |        |            |           |
| nette    | getQueryParameters()           |       |       |        | X          |           |
| pear     | getQueryVariables()            |       |       |        |            | X         |
| xpforge  | params()                       |       |       | X      |            |           |
| zenstr   | $parameters, withQueryParams() |       |       | X      | X          |           |

### User Information Component

7 of the 16 projects offer a string of the combined username and password portions of the URI, [per the RFC](https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2.1), either via a getter method or a property:

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
| nette    |                  |
| opis     | X                |
| pear     | X                |
| psr      | X                |
| rowbot   |                  |
| xpforge  |                  |
| zenstr   | X                |

When the user information component is offered, the "info" portion of the term is capitalized differently in different projects:

|         | Info | info |
| ------- | ---- | ---- |
| ci4     |      | X    |
| laminas | X    |      |
| league  | X    |      |
| opis    | X    |      |
| pear    |      | X    |
| psr     |      | X    |
| zenstr  | X    |      |

The ability to modify user information *per se* is present in only 4 of the projects; the method signature usually separates the user name from the password. (It is more common to modify the user name and password independently.)

|         | Method                                                                              |
| ------- | ----------------------------------------------------------------------------------- |
| laminas | `setUserInfo($userinfo)`                                                            |
| league  | `withUserInfo(?string $user, ?string $password = null)`                             |
| pear    | `setUserinfo($userinfo, $password = false)`                                         |
| psr     | `withUserInfo(string $user, ?string $password = null)`                              |

### Authority Component

9 of the projects offer a combined string of the username, password, host, and port portions of the URI, [per the RFC](https://datatracker.ietf.org/doc/html/rfc3986/#section-3.2), either via a getter method or a property.

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
| nette    |           |
| opis     | X         |
| pear     | X         |
| psr      | X         |
| rowbot   |           |
| xpforge  | X         |
| zenstr   | X         |

When the authority component is offered, the term "authority" is always used.

The ability to modify the authority value *per se* is not present in any project. The projects all opt to modify the sub-components of the authority independently.

## Parsing

### Approaches

These projects use these approaches to parsing URL component values.

|          | parse_url() | RFC 3986 | RFC 3987 | WHATWG-URL | None |
| -------- | ----------- | -------- | -------- | ---------- | ---- |
| amphp    | X           |          |          |            |      |
| aura     | X           |          |          |            |      |
| ci4      | X           |          |          |            |      |
| codezero | X           |          |          |            |      |
| joomla   | X (1)       |          |          |            |      |
| josan    | X           |          |          |            |      |
| justking | X           |          |          |            |      |
| laminas  |             | X        |          |            |      |
| league   |             | X        | X        |            |      |
| nette    | X (2)       |          |          |            |      |
| opis     |             | X        |          |            |      |
| pear     |             | X        |          |            |      |
| psr      |             |          |          |            | X    |
| rowbot   |             |          |          | X          |      |
| xpforge  |             | X        |          |            |      |
| zenstr   | X           |          |          |            |      |

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
| nette    | `Url::__construct(string\|Url\|UrlImmutable\|null $url = null)`                                      |
| opis     | `Uri::create(string $uri, bool $normalize = false) : ?Uri`                                           |
| pear     | `Net_URL2::__construct(string $url, array $options = array())`                                       |
| psr      | `UriFactoryInterface::createUri(string $uri = '') : UriInterface`                                    |
| rowbot   | `Url::parse(string\|Stringable $url, string\|Stringable\|null $base = null) : ?Url`                  |
| xpforge  | `Uri::__construct(string\|Creation $base, ?string $relative = null)`                                 |
| zenstr   | `ParsedUri::new(ParsedUri\|string\|null $what = null) : ParsedUri`                                   |


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
| nette    | _InvalidArgumentException_ |                            |                                                                              |
| opis     |                            |                            |                                                                              |
| pear     |                            |                            |                                                                              |
| psr      |                            | _InvalidArgumentException_ |                                                                              |
| rowbot   |                            |                            |                                                                              |
| xpforge  | _Exception_                | _Exception_                | _lang\\{FormatException, IllegalStateException}_                             |
| zenstr   | _InvalidArgumentException_ | _InvalidArgumentException_ |                                                                              |

* * *
