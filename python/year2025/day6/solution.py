from functools import reduce
from pathlib import Path

def solve_part_1(puzzle_input: str) -> int:
    worksheet = [line.strip().split() for line in puzzle_input.strip().splitlines()]
    sum = 0

    for equation in zip(*worksheet):
        sum += calc(equation[-1], equation[:-1])

    return sum

def calc(operation: str, operands) -> int:
    return reduce(lambda a, b: eval(f"{a}{operation}{b}"), operands)

def solve_part_2(puzzle_input: str) -> int:
    worksheet = [list(line) for line in puzzle_input.splitlines()]

    data, operations = worksheet[:-1], worksheet[-1]
    data = [''.join(a).strip() for a in zip(*data)]

    operations = list(filter(lambda c: len(c.strip()) > 0,operations))
    operations.reverse()

    sum = 0
    numbers_list = []

    for number in data:
        if number:
            numbers_list.append(number)
        else:
            sum += calc(operations.pop(), numbers_list)
            numbers_list.clear()

    sum += calc(operations.pop(), numbers_list)

    return sum

if __name__ == '__main__':
    with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read()

    print(f"Part 1: {solve_part_1(puzzle_input)}")
    print(f"Part 2: {solve_part_2(puzzle_input)}")