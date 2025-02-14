<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * Implementation set hook arguments MUST expect the representation state
 * described in the _Uri_ interface. If a property is to be represented in its
 * decoded state, the set hook MUST treat its argument as already decoded.
 * Likewise, if a property is to be represented in its encoded state, the set
 * hook MUST treat its argument as already encoded.
 *
 * Implementations MUST keep `$queryParams` and `$query` in sync; if one is
 * modified, the other MUST be modified accordingly.
 */
interface MutableUri extends Uri
{
    /**
     * @inheritdoc
     */
    public string $scheme { get; set; }

    /**
     * @inheritdoc
     */
    public string $user { get; set; }

    /**
     * @inheritdoc
     */
    public string $password { get; set; }

    /**
     * @inheritdoc
     */
    public string $host { get; set; }

    /**
     * @inheritdoc
     */
    public ?int $port { get; set; }

    /**
     * @inheritdoc
     */
    public string $path { get; set; }

    /**
     * @inheritdoc
     */
    public string $query { get; set; }

    /**
     * @inheritdoc
     */
    public string $fragment { get; set; }

    /**
     * @inheritdoc
     */
    public array $queryParams { get; set; }
}
