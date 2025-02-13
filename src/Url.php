<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * Implmentations with this marker interface MUST throw _LogicException_ (or an
 * extension thereof) if `$scheme` is empty or consists only of whitespace.
 */
interface Url extends Uri
{
}
