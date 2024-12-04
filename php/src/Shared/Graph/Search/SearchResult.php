<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\RuntimeException;

final readonly class SearchResult
{
    /** @var Path[] */
    private array $paths;

    public function __construct(Path ...$paths)
    {
        $this->paths = $paths;
    }

    public function path(): Path
    {
        if (count($this->paths) > 1) {
            throw new RuntimeException('More than one path found');
        }

        return $this->paths[0];
    }
}
