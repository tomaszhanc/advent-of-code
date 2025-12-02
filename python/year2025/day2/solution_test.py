import pytest
from pathlib import Path
from python.year2025.day2.solution import solve_part_1, solve_part_2

with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read().strip()
example_input = "11-22,95-115,998-1012,1188511880-1188511890,222220-222224,1698522-1698528,446443-446449,38593856-38593862,565653-565659,824824821-824824827,2121212118-2121212124"

@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 1227775554),
        (puzzle_input, 12586854255)
    ]
)
def test_solve_part_1(input, expected):
    assert solve_part_1(input) == expected


@pytest.mark.parametrize(
    "input, expected",
    [
        (example_input, 4174379265),
        (puzzle_input, 17298174201)
    ]
)
def test_solve_part_2(input, expected):
    assert solve_part_2(input) == expected