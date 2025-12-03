from pathlib import Path


def solve_part_1(puzzle_input: str) -> int:
    banks = [list(banks) for banks in puzzle_input.strip().splitlines()]

    output_joltage = 0
    for bank in banks:
        output_joltage += largest_joltage(bank, 2)

    return output_joltage


def solve_part_2(puzzle_input: str) -> int:
    batteries_list = [list(batteries) for batteries in puzzle_input.strip().splitlines()]

    output_joltage = 0
    for bank in batteries_list:
        output_joltage += largest_joltage(bank, 12)

    return output_joltage


def largest_joltage(bank: list[str], num_of_batteries: int) -> int:
    remaining = bank
    selected = []

    for picks_left in range(num_of_batteries, 0, -1):
        if len(remaining) == picks_left:
            selected.extend(remaining)
            break

        search_window = remaining[:len(remaining) - picks_left + 1]
        biggest_battery = max(search_window)
        selected.append(biggest_battery)
        remaining = remaining[remaining.index(biggest_battery) + 1:]

    return int(''.join(selected))


if __name__ == '__main__':
    with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read().strip()

    print(f"Part 1: {solve_part_1(puzzle_input)}")
    print(f"Part 2: {solve_part_2(puzzle_input)}")
