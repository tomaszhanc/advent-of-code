import {Location, locationToString, nextInDirections} from "./Location";
import {Direction} from "./Direction";

export type Cell<T> = {
    readonly location: Location,
    readonly value: T | null
};

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

    public static fromMap<T>(cells : Map<Location, T>): Grid<T> {
        const gridCells = new Map<string, T>();
        let width = 0;
        let height = 0;

        for (let [location, value] of cells.entries()) {
            width = Math.max(width, location.x + 1);
            height = Math.max(height, location.y + 1);
            gridCells.set(locationToString(location), value);
        }

        return new Grid<T>(width, height, gridCells);
    }

    public firstLocationOf(value: T): Location | null {
        for (const [key, cell] of this.cells.entries()) {
            if (value === cell) {
                return Location.fromString(key);
            }
        }

        return null;
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

    public nextInDirections(location: Location, directions: Direction[]) : Cell<T>[] {
        return nextInDirections(location, directions)
            .filter(location => this.hasInBounds(location))
            .map(location => this.cellAt(location));
    }

    public setValue(value: T, ...locations: Location[]): Grid<T> {
        if (locations.length === 0) {
            throw new Error('No locations provided');
        }

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