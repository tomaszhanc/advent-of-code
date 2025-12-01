import pytest
from pathlib import Path
from python.year2025.day1.day1 import solve_part_1, turn_the_dial, solve_part_2

with open(Path(__file__).parent / f"day1.txt") as f: puzzle_input = f.read().strip().splitlines()

@pytest.mark.parametrize(
    "dial,rotation,expected",
    [
        (11, "R8", 19),
        (19, "L19", 0),
        (0, "L1", 99),
        (5, "L10", 95),
        (95, "R5", 0),
        (95, "R15", 10),
        (95, "R500", 95),
        (95, "L500", 95),
    ]
)
def test_turn_the_dial(dial, rotation, expected):
    assert turn_the_dial(dial, rotation) == expected

@pytest.mark.parametrize(
    "input, expected",
    [
        (["L68", "L30", "R48", "L5", "R60", "L55", "L1", "L99", "R14", "L82"], 3),
        (puzzle_input, 1076)
    ]
)
def test_solve_part_1(input, expected):
    assert solve_part_1(input) == expected


@pytest.mark.parametrize(
    "input, expected",
    [
        (["L68", "L30", "R48", "L5", "R60", "L55", "L1", "L99", "R14", "L82"], 6),
        (puzzle_input, 6379)
    ]
)
def test_solve_part_2(input, expected):
    assert solve_part_2(input) == expected