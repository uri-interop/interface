<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * Indicates that the implementation component values were generated from a
 * parser conforming to WHATWG-URL.
 *
 * Implementation `__toString()` return values MUST be composed according to
 * WHATWG-URL.
 */
interface WhatwgUrl extends Url
{
}
