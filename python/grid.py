DIRECTIONS = {
    "NW": [-1, -1],
    "N":  [ 0, -1],
    "NE": [ 1, -1],
    "SW": [-1,  1],
    "S":  [ 0,  1],
    "SE": [ 1,  1],
    "W":  [-1,  0],
    "E":  [ 1,  0]
}

Grid = dict[tuple[int, int], str]

def create_grid(rows: list[str]) -> Grid:
    grid = {}
    for y, row in enumerate(rows):
        for x, val in enumerate(row):
            grid[(x, y)] = val
    return grid