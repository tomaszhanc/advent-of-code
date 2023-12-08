<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Common\Filesystem;

final readonly class DocumentCalibrator
{
    public function __construct(private Filesystem $filesystem, private LineCalibrator $lineCalibrator) { }

    public function calibrate(string $documentPath) : int
    {
        $calibrationNumber = 0;

        foreach($this->filesystem->readLineByLine($documentPath) as $line) {
            $calibrationNumber += $this->lineCalibrator->calibrationNumber($line)->asInteger();
        }

        return $calibrationNumber;
    }
}
