import {Location, locationToString, nextInDirections, Position} from "./Position.js";
import {Direction} from "./Direction.js";

const EMPTY_CELL = '.';

export class Grid {
    private constructor(
        public readonly cells: Map<string, string>,
        public readonly width: number,
        public readonly height: number
    ) {
    }

    public static empty(width: number, height: number): Grid {
        return new Grid(new Map<string, string>, width, height);
    }

    public static fromString(data: string): Grid {
        return Grid.fromArray(data.trim().split('\n').map(line => line.split('')));
    }

    public static fromArray(rows: string[][]): Grid {
        const cells = new Map<string, string>();
        let width = 0;

        for (let y = 0; y < rows.length; y++) {
            width = Math.max(width, rows[y].length);
            for (let x = 0; x < rows[y].length; x++) {
                if (rows[y][x] !== EMPTY_CELL) {
                    cells.set(locationToString({x, y}), rows[y][x]);
                }
            }
        }

        return new Grid(cells, width, rows.length);
    }

    public static create(cells: Map<Location|string, string>, width: number | null = null, height: number | null = null): Grid {
        const gridCells = new Map<string, string>();
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

        return new Grid(gridCells, width, height);
    }

    public firstPositionOf(value: string): Position {
        for (const [key, cell] of this.cells.entries()) {
            if (value === cell) {
                return Position.fromString(key);
            }
        }

        throw new Error(`Value not found: ${value}`);
    }

    public allPositionsOf(value: string): Position[] {
        return Array.from(this.cells)
            .filter(([_, cell]) => cell === value)
            .map(([key, _]) => Position.fromString(key));
    }

    public valueAt(location: Location): string | null {
        if (!this.hasInBounds(location)) {
            throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
        }

        return this.cells.get(locationToString(location)) ?? null;
    }

    public cellAt(location: Location) : Cell {
        if (!this.hasInBounds(location)) {
            throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
        }

        return { location, value: this.valueAt(location) };
    }

    public nextInDirection(location: Location, direction: Direction) : Cell | null {
        return this.nextInDirections(location, [direction])[0] ?? null;
    }

    public nextInDirections(location: Location, directions: Direction[]) : Cell[] {
        return nextInDirections(location, directions)
            .filter(next => this.hasInBounds(next))
            .map(next => this.cellAt(next));
    }

    public move(currentLocation: Location, newLocation: Location) : Grid {
        const newCells = new Map<string, string>(this.cells.entries());
        const currentValue = this.valueAt(currentLocation);

        if (currentValue === null) {
            throw new Error(`Cannot move empty location: ${currentLocation.x}, ${currentLocation.y}`);
        }

        if (this.valueAt(newLocation) !== null && this.valueAt(newLocation) !== EMPTY_CELL) {
            throw new Error(`Cannot move to an occupied location: ${newLocation.x}, ${newLocation.y}`);
        }

        newCells
            .set(locationToString(currentLocation), EMPTY_CELL)
            .set(locationToString(newLocation), currentValue)

        return new Grid(newCells, this.width, this.height);
    }

    public setValueAt(value: string, ...locations: Location[]): Grid {
        const newCells = new Map<string, string>(this.cells.entries());

        locations.forEach(location => {
            if (!this.hasInBounds(location)) {
                throw new Error(`Location out of bounds: ${location.x}, ${location.y}`);
            }

            newCells.set(locationToString(location), value);
        })

        return new Grid(newCells, this.width, this.height);
    }

    public forEach(callback: (location: Location, value: string | null) => void): void {
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

export type Cell = {
    readonly location: Location,
    readonly value: string | null
};

export function isWall(cell: Cell) {
    return cell.value === '#';
}