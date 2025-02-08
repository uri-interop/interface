<?php
declare(strict_types=1);

namespace UriInterop\Interface;

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
