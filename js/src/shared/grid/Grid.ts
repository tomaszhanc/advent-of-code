import {Location, locationAsString} from "./Location";

export type GridType = string | number;

export class Grid<T extends GridType> {
    private constructor(
        public readonly width: number,
        public readonly height: number,
        public readonly cells: Map<string, T>
    ) {
    }

    public static empty<T extends GridType>(width: number, height: number): Grid<T> {
        return new Grid(width, height, new Map<string, T>());
    }

    public static fromArray<T extends GridType>(grid: T[][], emptyCell: T | null = null): Grid<T> {
        let cells = new Map<string, T>();

        for (let y = 0; y < grid.length; y++) {
            for (let x = 0; x < grid[y].length; x++) {
                if (grid[y][x] !== emptyCell) {
                    cells.set(locationAsString({x, y}), grid[y][x]);
                }
            }
        }

        return new Grid(grid[0].length, grid.length, cells);
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

        return this.cells.get(locationAsString(location)) ?? null;
    }

    public setValue(value: T, location: Location): Grid<T> {
        if (!this.hasInBounds(location)) {
            throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
        }

        let newGrid = new Map<string, T>(this.cells.entries());
        newGrid.set(locationAsString(location), value);

        return new Grid(this.width, this.height, newGrid);
    }

    public hasInBounds(location: Location): boolean {
        return location.x >= 0 && location.x < this.width
            && location.y >= 0 && location.y < this.height
    }

    public groupByValue() : Map<T, Location[]>{
        const groups = new Map<T, Location[]>();

        for (const [cellKey, cellValue] of this.cells.entries()) {
            if (!groups.has(cellValue)) {
                groups.set(cellValue, []);
            }

            groups.get(cellValue)!.push(Location.fromString(cellKey));
        }

        return groups;
    }
}