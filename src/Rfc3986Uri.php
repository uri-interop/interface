<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * Indicates that the implementation component values were generated from a
 * parser conforming to RFC 3986.
 *
 * Implementation `__toString()` return values MUST be composed according to
 * RFC 3986.
 */
interface Rfc3986Uri extends Uri
{
}
