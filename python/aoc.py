from pathlib import Path


def read_puzzle_input(year: int, day: int) -> str:
    path = Path(__file__).parent / f"year{year}" / "inputs" / f"day{day}.txt"

    with open(path) as f:
        return f.read()



