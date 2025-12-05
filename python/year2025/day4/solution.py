from pathlib import Path
from grid import Grid, create_grid, DIRECTIONS

ROLL_OF_PAPER = '@'
EMPTY = '.'

def solve_part_1(puzzle_input: str) -> int:
    grid = create_grid(puzzle_input.strip().splitlines())
    return count_accessible_places(grid, False)

def solve_part_2(puzzle_input: str) -> int:
    grid = create_grid(puzzle_input.strip().splitlines())
    return count_accessible_places(grid, True)

def count_accessible_places(grid: Grid, with_removal: bool) -> int:
    accessible_places = 0

    for (x, y), val in grid.items():
        if val != ROLL_OF_PAPER: continue
        rolls_count = 0

        for dx, dy in DIRECTIONS.values():
            if grid.get((x + dx, y + dy)) == ROLL_OF_PAPER:
                rolls_count += 1
            if rolls_count == 4: break

        if rolls_count < 4:
            accessible_places += 1
            if with_removal: grid[(x, y)] = EMPTY

    if with_removal and accessible_places > 0:
        return accessible_places + count_accessible_places(grid, True)

    return accessible_places

if __name__ == '__main__':
    with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read()

    print(f"Part 1: {solve_part_1(puzzle_input)}")
    print(f"Part 2: {solve_part_2(puzzle_input)}")