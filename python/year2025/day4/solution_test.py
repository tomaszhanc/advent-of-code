import pytest
from pathlib import Path
from python.year2025.day4.solution import solve_part_1, solve_part_2

with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read()
example_input = """..@@.@@@@.
@@@.@.@.@@
@@@@@.@.@@
@.@@@@..@.
@@.@@@@.@@
.@@@@@@@.@
.@.@.@.@@@
@.@@@.@@@@
.@@@@@@@@.
@.@.@@@.@.
"""

@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 13),
        (puzzle_input, 1547)
    ]
)
def test_solve_part_1(input, expected):
    assert solve_part_1(input) == expected


@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 43),
        (puzzle_input, 8948)
    ]
)
def test_solve_part_2(input, expected):
    assert solve_part_2(input) == expected