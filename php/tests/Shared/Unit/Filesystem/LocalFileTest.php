<?php

namespace Advent\Tests\Shared\Unit\Filesystem;

use Advent\Shared\Filesystem\LocalFile;
use Advent\Shared\Filesystem\SimpleFilesystem;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LocalFileTest extends TestCase
{
    #[Test]
    public function it_iterates_over_all_lines_in_the_file(): void
    {
        $localFile = new LocalFile(
            new SimpleFilesystem(),
            __DIR__ . '/../../Resources/1000_lines.txt'
        );

        $this->assertCount(1000, \iterator_to_array($localFile->lines()));
    }
}
