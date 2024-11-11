<?php

declare(strict_types=1);

namespace Advent\Shared\Input;

interface Input
{
    /** @return \Iterator<string> */
    public function lines(): \Iterator;

    public function content(): string;
}
