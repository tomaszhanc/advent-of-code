from collections import deque
from itertools import combinations

from aoc import read_puzzle_input

GALAXY = '#'

class Grid:
    def __init__(self, data: str):
        self.grid = [list(line) for line in data.strip().splitlines()]
        self.height = len(self.grid)
        self.width = len(self.grid[0])

    def in_bounds(self, location: tuple) -> bool:
        return (location[0] >= 0 & location[0] < self.width
              & location[1] >= 0 & location[1] < self.height)

def create_grid(data: str) -> list[list[str]]:
    return [list(line) for line in data.strip().splitlines()]\

def transpose_grid(grid: list[list[str]]) -> list[list[str]]:
    return [list(row) for row in zip(*grid)]

def distance(start: tuple, end: tuple) -> int:
    return abs(start[0] - end[0]) + abs(start[1] - end[1])

def print_grid(grid: list[list[str]]) -> None:
    print("    " + "".join(str(i % 10) for i in range(len(grid[0]))))
    for i, row in enumerate(grid):
        print(f"{i:2d}: {''.join(row)}")

def solve_part_1(input: str) -> int:
    universe = create_grid(input)
    universe = expand_universe(universe)

    galaxies = set()
    for x, row in enumerate(universe):
        for y, col in enumerate(row):
            if col == '#':
                galaxies.add((x, y))

    sum = 0
    for start, end in combinations(galaxies, 2):
        sum += distance(start, end)
        # sum += shortest_path(universe, start, end)


    return sum

def shortest_path(grid: list[list[str]], start: tuple, end: tuple):
    rows, cols = len(grid), len(grid[0])

    q = deque([(start, 0)])
    seen = {start}

    while q:
        (x, y), d = q.popleft()
        if (x, y) == end:
            return d
        for dx, dy in [(-1,0),(1,0),(0,-1),(0,1)]:
            nx, ny = x+dx, y+dy
            if 0<=nx<rows and 0<=ny<cols and (nx,ny) not in seen:
                seen.add((nx,ny))
                q.append(((nx,ny), d+1))
    return -1


def expand_universe(universe: list[list[str]]) -> list[list[str]]:
    half_expanded_universe = expand_universe_row(universe)
    fully_expanded_universe = expand_universe_row(transpose_grid(half_expanded_universe))
    return transpose_grid(fully_expanded_universe)

def expand_universe_row(universe: list[list[str]]) -> list[list[str]]:
    expanded_universe = universe.copy()
    expansions = 0

    for row_number, row in enumerate(universe):
        if without_galaxy(row):
            expanded_universe.insert(row_number + expansions, ['.'] * len(row))
            expansions += 1

    return expanded_universe

def without_galaxy(row: list[str]) -> bool:
    return len(row) == len(list(filter(lambda c: c != GALAXY, row)))

def solve_part_2(input: str) -> int:

    return -1

if __name__ == '__main__':
    input = read_puzzle_input(2023, 11)

#     input = """
# ...#......
# .......#..
# #.........
# ..........
# ......#...
# .#........
# .........#
# ..........
# .......#..
# #...#.....
# """


    print('Part 1: ', solve_part_1(input))
    # print('Part 2: ', solve_part_2(input))