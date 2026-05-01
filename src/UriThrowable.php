<?php
declare(strict_types=1);

namespace UriInterop\Interface;

use Throwable;

/**
 * [_UriThrowable_][] is a marker interface that extends [_Throwable_][] to
 * indicate an [_Exception_][] is URI-related.
 *
 * It adds no class members.
 */
interface UriThrowable extends Throwable
{
}
