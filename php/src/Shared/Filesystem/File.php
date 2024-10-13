<?php

declare(strict_types=1);

namespace Advent\Shared\Filesystem;

interface File
{
    /** @return string[] */
    public function lines(): iterable;
}
