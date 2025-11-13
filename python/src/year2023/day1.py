import re

from aoc import read_puzzle_input_lines

def calibration_value_for_digits(line: str) -> int:
    line = ''.join([c for c in line if c.isdigit()])

    first_digit = line[0] if len(line) > 0 else 0
    last_digit = line[-1] if len(line) > 0 else 0

    return int(''.join([first_digit, last_digit]))

def calibration_value_for_digits_and_spelled_out_digits(line: str) -> int:
    digit_map = {
        'zero': '0', 'one': '1', 'two': '2', 'three': '3', 'four': '4',
        'five': '5', 'six': '6', 'seven': '7', 'eight': '8', 'nine': '9'
    }
    pattern = r'(?=(zero|one|two|three|four|five|six|seven|eight|nine|\d))'

    matches = re.findall(pattern, line)
    result = [digit_map.get(m, m) for m in matches]
    line = ''.join(result)

    return calibration_value_for_digits(line)

def solve_part_1(calibration_document: list[str]) -> int:
    ret = sum(list(map(calibration_value_for_digits, calibration_document)))
    return ret

def solve_part_2(calibration_document: list[str]) -> int:
    ret = sum(list(map(calibration_value_for_digits_and_spelled_out_digits, calibration_document)))
    return ret

if __name__ == '__main__':
    calibration_document = read_puzzle_input_lines(2023, 1)

    print('Part 1: ', solve_part_1(calibration_document))
    print('Part 2: ', solve_part_2(calibration_document))