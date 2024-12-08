import {Location} from "./Location";

type GridType = string | number;

export class Grid<T extends GridType> {
    private constructor(
        public readonly width: number,
        public readonly height: number,
        private readonly cells: Map<string, T>,
        private readonly emptyCell: T
    ) {
    }

    public static fromArray<T extends GridType>(grid: T[][], emptyCell: T): Grid<T> {
        let cells = new Map<string, T>();

        for (let y = 0; y < grid.length; y++) {
            for (let x = 0; x < grid[y].length; x++) {
                if (grid[y][x] !== emptyCell) {
                    cells.set(new Location(x, y).toString(), grid[y][x]);
                }
            }
        }

        return new Grid(grid[0].length, grid.length, cells, emptyCell);
    }

    public locationOf(value: T): Location | null {
        for (const [key, cell] of this.cells.entries()) {
            if (value === cell) {
                return Location.fromString(key);
            }
        }

        return null;
    }

    public valueOf(location: Location): T {
        if (!this.contains(location)) {
            throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
        }

        return this.cells.get(location.toString()) ?? this.emptyCell;
    }

    public setValue(value: T, location: Location): Grid<T> {
        if (!this.contains(location)) {
            throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
        }

        let newGrid = new Map<string, T>(this.cells.entries());
        newGrid.set(location.toString(), value);

        return new Grid(this.width, this.height, newGrid, this.emptyCell);
    }

    public contains(location: Location): boolean {
        return location.x >= 0 && location.x < this.width
            && location.y >= 0 && location.y < this.height
    }

    public toString(): string {
        let result = '';

        for (let y = 0; y < this.height; y++) {
            for (let x = 0; x < this.width; x++) {
                result += this.valueOf(new Location(x, y));
            }
            result += '\n';
        }

        return result;
    }
}