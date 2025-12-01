import pytest
from python.year2023.day1.day1 import *

@pytest.mark.parametrize("calibration_document,expected_calibration_value", [
    (
        """1abc2
        pqr3stu8vwx
        a1b2c3d4e5f
        treb7uchet""",
        142
    ),
    (
        read_puzzle_input(2023, 1),
        54597
    ),
])
def test_solve_part_1(calibration_document, expected_calibration_value):
    result = solve_part_1(calibration_document)

    assert result == expected_calibration_value


@pytest.mark.parametrize("calibration_document,expected_calibration_value", [
    (
        """two1nine
        eightwothree
        abcone2threexyz
        xtwone3four
        4nineeightseven2
        zoneight234
        7pqrstsixteen""",
        281
    ),
    (
        read_puzzle_input(2023, 1),
        54504
    ),
])
def test_solve_part_2(calibration_document, expected_calibration_value):
    result = solve_part_2(calibration_document)

    assert result == expected_calibration_value