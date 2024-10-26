<?php

declare(strict_types=1);

namespace Advent\Shared\Filesystem;

interface File
{
    /** @return \Iterator<string> */
    public function lines(): \Iterator;

    public function content(): string;
}
