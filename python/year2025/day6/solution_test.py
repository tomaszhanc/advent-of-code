import pytest
from pathlib import Path
from year2025.day6.solution import solve_part_1, solve_part_2

with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read()
example_input = """123 328  51 64 
 45 64  387 23 
  6 98  215 314
*   +   *   +
"""

@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 4277556),
        (puzzle_input, 5316572080628)
    ]
)
def test_solve_part_1(input, expected):
    assert solve_part_1(input) == expected


@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 3263827),
        (puzzle_input, 11299263623062)
    ]
)
def test_solve_part_2(input, expected):
    assert solve_part_2(input) == expected