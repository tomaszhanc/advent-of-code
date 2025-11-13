from pathlib import Path

def read_puzzle_input_lines(year: int, day: int) -> list[str]:
    path = Path(__file__).parent / f"year{year}" / "inputs" / f"day{day}.txt"

    with open(path) as f:
        return f.read().strip().split("\n")