from pathlib import Path

def solve_part_1(puzzle_input: list[str]) -> int:
    dial = 50
    password = 0

    for rotation in puzzle_input:
        dial = turn_the_dial(dial, rotation)
        password += 1 if dial == 0 else 0

    return password

def solve_part_2(puzzle_input: list[str]) -> int:
    dial = 50
    password = 0

    for rotation in puzzle_input:
        unwrapped_position = apply_rotation(dial, rotation)

        if unwrapped_position > 0 or dial == 0:
            # R50 from 52  → crosses zero 1 time  (102/100 =1)
            # R550 from 52 → crosses zero 6 times (602/100 =6)
            # L20 from 0   → crosses zero 0 time  ( -20/100 = 0) - initial zero was already counted
            # L120 from 0  → crosses zero 0 time  (-120/100 =-1) - initial zero was already counted
            password += abs(int(unwrapped_position/100))
        else:
            # L20 from 10  → crosses zero 1 time  ( -10/100 -1 =-1)
            # L520 from 10 → crosses zero 6 times (-510/100 -1 =-6)
            password += abs(int(unwrapped_position/100 - 1))

        dial = unwrapped_position % 100

    return password

def turn_the_dial(dial: int, rotation: str) -> int:
    return apply_rotation(dial, rotation) % 100

def apply_rotation(dial: int, rotation: str) -> int:
    direction = rotation[0]
    clicks = int(rotation[1:])

    return dial + clicks if direction == "R" else dial - clicks

if __name__ == '__main__':
    with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read().strip().splitlines()

    print(f"Part 1: {solve_part_1(puzzle_input)}")
    print(f"Part 2: {solve_part_2(puzzle_input)}")

