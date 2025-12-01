import pytest
from python.year2023.day11.day11 import *

@pytest.mark.parametrize("input, expected", [
    (
            read_puzzle_input(2023, 11),
            0
    )
])
def test_solve_part_1(input, expected):
    result = solve_part_1(input)

    assert result == expected


@pytest.mark.parametrize("input, expected", [
    (
            read_puzzle_input(2023, 11),
            0
    )
])
def test_solve_part_2(input, expected):
    result = solve_part_2(input)

    assert result == expected