from pathlib import Path

def solve_part_1(puzzle_input: str) -> int:
    [fresh_ingredients, available_ingredients] = puzzle_input.strip().split("\n\n")
    fresh_ingredients = [[int(id) for id in line.split('-')] for line in fresh_ingredients.splitlines()]
    available_ingredients = [int(id) for id in available_ingredients.splitlines()]

    sum = 0
    for ingredient in available_ingredients:
        for from_id, to_id in fresh_ingredients:
            if from_id <= ingredient <= to_id:
                sum += 1
                break

    return sum


def solve_part_2(puzzle_input: str) -> int:
    [fresh_ingredients, _] = puzzle_input.strip().split("\n\n")
    fresh_ingredients = [[int(id) for id in line.split('-')] for line in fresh_ingredients.splitlines()]

    ranges = []
    fresh_ingredients.sort()

    for a in fresh_ingredients:
        merged = False
        for b in ranges:
            if a[0] <= b[0] <= a[1]:
                ranges.remove(b)
                ranges.append([a[0], max(a[1], b[1])])
                merged = True
                break

            if b[0] < a[0] <= b[1]:
                ranges.remove(b)
                ranges.append([b[0], max(a[1], b[1])])
                merged = True
                break

        if not merged: ranges.append(a)

    return sum(end - start + 1 for start, end in ranges)

if __name__ == '__main__':
    with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read()

    print(f"Part 1: {solve_part_1(puzzle_input)}")
    print(f"Part 2: {solve_part_2(puzzle_input)}")
