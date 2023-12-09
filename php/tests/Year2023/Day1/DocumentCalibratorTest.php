<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Year2023\Day1\LineCalibrator\LexerLineCalibration;
use AoC\Year2023\Day1\LineCalibrator\SimpleLineCalibrator;
use PHPUnit\Framework\TestCase;

final class DocumentCalibratorTest extends TestCase
{
    /**
     * @dataProvider line_calibrators
     */
    public function test_returns_sum_of_calibration_numbers_of_all_lines_in_a_document(LineCalibrator $lineCalibrator): void
    {
        $documentCalibrator = new DocumentCalibrator(new SimpleFilesystem(), $lineCalibrator);

        $this->assertSame(54504, $documentCalibrator->calibrate(__DIR__ . '/../Resources/day1.txt'));
    }

    public static function line_calibrators(): \Iterator
    {
        yield 'simple line calibrator' => [new SimpleLineCalibrator()];
        yield 'lexer line calibrator' => [new LexerLineCalibration()];
    }
}
