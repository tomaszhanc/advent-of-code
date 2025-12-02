from pathlib import Path

def solve_part_1(puzzle_input: str) -> int:
    product_id_ranges = [[int(product_id) for product_id in product_id_range.split('-')] for product_id_range in puzzle_input.split(',')]
    invalid_product_ids = set()

    for product_id_range in product_id_ranges:
        for product_id in range(product_id_range[0], product_id_range[1] + 1):
            product_id = str(product_id)
            half_length = len(product_id)//2

            if product_id[:half_length] == product_id[half_length:]:
                invalid_product_ids.add(int(product_id[:half_length]*2))

    return sum(invalid_product_ids)

def solve_part_2(puzzle_input: str) -> int:
    product_id_ranges = [[int(product_id) for product_id in product_id_range.split('-')] for product_id_range in puzzle_input.split(',')]
    invalid_product_ids = set()

    for product_id_range in product_id_ranges:
        for product_id in range(product_id_range[0], product_id_range[1] + 1):
            product_id = str(product_id)
            half_length = len(product_id)//2

            for pattern_length in range(1, half_length + 1):
                invalid_product_id = product_id[:pattern_length] * (len(product_id) // pattern_length)

                if product_id == invalid_product_id:
                    invalid_product_ids.add(int(invalid_product_id))

    return sum(invalid_product_ids)

if __name__ == '__main__':
    with open(Path(__file__).parent / f"puzzle_input.txt") as f: puzzle_input = f.read().strip()

    print(f"Part 1: {solve_part_1(puzzle_input)}")
    print(f"Part 2: {solve_part_2(puzzle_input)}")