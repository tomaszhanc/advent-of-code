import pytest
from pathlib import Path
from year2025.day5.solution import solve_part_1, solve_part_2

with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read()
example_input = """
3-5
10-14
16-20
12-18

1
5
8
11
17
32
"""

@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 3),
        (puzzle_input, 735)
    ]
)
def test_solve_part_1(input, expected):
    assert solve_part_1(input) == expected


@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 14),
        (puzzle_input, 344306344403172)
    ]
)
def test_solve_part_2(input, expected):
    assert solve_part_2(input) == expected
