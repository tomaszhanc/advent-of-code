import {Location, locationToString, nextInDirections} from "./Location.js";
import {Direction} from "./Direction.js";

export function createGrid(data: string) : Map<string, string> {
    const grid = new Map<string, string>();
    const rows = data.trim().split('\n');

    for (let y = 0; y < rows.length; y++) {
        for (let x = 0; x < rows[y].length; x++) {
            grid.set(`${x},${y}`, rows[y][x]);
        }
    }

    return grid;
}

export function isWall(cell: Cell<string>) {
    return cell.value === '#';
}

/**
 * I'm experimenting with class Grid and
 * just a Map<string, string> to see which one I like better.
 */
export class Grid<T> {
    private constructor(
        public readonly width: number,
        public readonly height: number,
        public readonly cells: Map<string, T>
    ) {
    }

    public static empty<T>(width: number, height: number): Grid<T> {
        return new Grid(width, height, new Map<string, T>());
    }

    public static fromString<T>(data: string): Grid<T> {
        return Grid.fromArray(
            data.trim().split('\n').map(line => line.split('').map(cell => cell as T)),
        );
    }

    public static fromArray<T>(grid: T[][], emptyCell: T | null = null): Grid<T> {
        const cells = new Map<string, T>();

        for (let y = 0; y < grid.length; y++) {
            for (let x = 0; x < grid[y].length; x++) {
                if (grid[y][x] !== emptyCell) {
                    cells.set(locationToString({x, y}), grid[y][x]);
                }
            }
        }

        return new Grid(grid[0].length, grid.length, cells);
    }

    public static withCells<T>(cells : Map<Location|string, T>, width: number | null = null, height: number | null = null): Grid<T> {
        const gridCells = new Map<string, T>();
        let maxWidth = 0;
        let maxHeight = 0;

        for (let [location, value] of cells.entries()) {
            if (typeof location === 'string') {
                location = Location.fromString(location);
            }

            maxWidth = Math.max(maxWidth, location.x + 1);
            maxHeight = Math.max(maxHeight, location.y + 1);
            gridCells.set(locationToString(location), value);
        }

        width = width ?? maxWidth;
        height = height ?? maxHeight;

        if (maxHeight > height) throw new Error(`At least on cell is out of bounds in the y-axis`);
        if (maxWidth > width) throw new Error(`At least on cell is out of bounds in the x-axis`);

        return new Grid<T>(width, height, gridCells);
    }

    public firstLocationOf(value: T): Location {
        for (const [key, cell] of this.cells.entries()) {
            if (value === cell) {
                return Location.fromString(key);
            }
        }

        throw new Error(`Value not found: ${value}`);
    }

    public allLocationsOf(value: T): Location[] {
        return Array.from(this.cells)
            .filter(([key, cell]) => cell === value)
            .map(([key, cell]) => Location.fromString(key));
    }

    public valueAt(location: Location): T | null {
        if (!this.hasInBounds(location)) {
            throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
        }

        return this.cells.get(locationToString(location)) ?? null;
    }

    public cellAt(location: Location) : Cell<T> {
        if (!this.hasInBounds(location)) {
            throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
        }

        return {
            location,
            value: this.valueAt(location)
        };
    }

    public nextInDirection(location: Location, direction: Direction) : Cell<T> | null {
        return this.nextInDirections(location, [direction])[0] ?? null;
    }

    public nextInDirections(location: Location, directions: Direction[]) : Cell<T>[] {
        return nextInDirections(location, directions)
            .filter(next => this.hasInBounds(next))
            .map(next => this.cellAt(next));
    }

    public setValueAt(value: T, ...locations: Location[]): Grid<T> {
        let newGrid = new Map<string, T>(this.cells.entries());

        locations.forEach(location => {
            if (!this.hasInBounds(location)) {
                throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
            }

            newGrid.set(locationToString(location), value);
        })

        return new Grid(this.width, this.height, newGrid);
    }

    public forEach(callback: (location: Location, value: T | null) => void): void {
        for (let y = 0; y < this.height; y++) {
            for (let x = 0; x < this.width; x++) {
                const location = {x, y};
                callback(location, this.valueAt(location));
            }
        }
    }

    public hasInBounds(location: Location): boolean {
        return location.x >= 0 && location.x < this.width
            && location.y >= 0 && location.y < this.height
    }
}

export type Cell<T> = {
    readonly location: Location,
    readonly value: T | null
};