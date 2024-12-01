<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

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
        return $this->paths[0];
    }

    public function maxDistance(): int
    {
        return max(
            array_map(
                fn (Path $path) => $path->distance(),
                $this->paths
            )
        );
    }
}
