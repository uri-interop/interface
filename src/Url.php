<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * Indicates a scheme component must be present.
 *
 * Implmentations MUST throw _LogicException_ (or an extension thereof) if
 * `$scheme` is empty or composed only of whitespace.
 */
interface Url extends Uri
{
}
