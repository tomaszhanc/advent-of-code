import pytest
from pathlib import Path
from year2025.day3.solution import solve_part_1, solve_part_2

with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read().strip()
example_input = """987654321111111
811111111111119
234234234234278
818181911112111"""

@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 357),
        (puzzle_input, 16842)
    ]
)
def test_solve_part_1(input, expected):
    assert solve_part_1(input) == expected


@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 3121910778619),
        (puzzle_input, 167523425665348)
    ]
)
def test_solve_part_2(input, expected):
    assert solve_part_2(input) == expected