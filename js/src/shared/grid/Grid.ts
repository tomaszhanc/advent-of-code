import {Location} from "./Location";

export class Grid<T extends string | number> {
    constructor(
        private readonly grid: T[][]
    ) {
    }

    public get height() : number {
        return this.grid.length;
    }

    public get width() : number {
        return this.grid[0].length;
    }

    public locationOf(value: T) : Location | null {
        for (let y = 0; y < this.grid.length; y++) {
            const x = this.grid[y].indexOf(value);

            if (x !== -1) {
                return new Location(x, y);
            }
        }

        return null;
    }

    public valueOf(location: Location) : T | null {
        if (location.x < 0 || location.y < 0) {
            return null;
        }

        if (location.y >= this.grid.length) {
            return null;
        }

        if (location.x >= this.grid[location.y].length) {
            return null;
        }

        return this.grid[location.y][location.x];
    }

    public setValue(value : T, location : Location) : Grid<T> {
        let newGrid = this.grid.map(row => row.slice());
        newGrid[location.y][location.x] = value;

        return new Grid(newGrid);
    }
}
