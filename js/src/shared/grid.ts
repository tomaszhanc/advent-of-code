export enum Direction {
    UP = 1,
    DOWN = 2,
    LEFT = 4,
    RIGHT = 8,
    UP_LEFT = UP | LEFT,
    UP_RIGHT = UP | RIGHT,
    DOWN_LEFT = DOWN | LEFT,
    DOWN_RIGHT = DOWN | RIGHT,
}

export namespace Direction {
    export function rotateClockwise(direction : Direction) : Direction {
        switch (direction) {
            case Direction.UP: return Direction.RIGHT;
            case Direction.RIGHT: return Direction.DOWN;
            case Direction.DOWN: return Direction.LEFT;
            case Direction.LEFT: return Direction.UP;
        }

        throw new Error(`Invalid direction: ${direction}`);
    }
}

export class Location {
    constructor(
        public readonly x: number,
        public readonly y: number
    ) {
    }

    next(direction: Direction): Location {
        switch (direction) {
            case Direction.UP:
                return new Location(this.x, this.y - 1);
            case Direction.DOWN:
                return new Location(this.x, this.y + 1);
            case Direction.LEFT:
                return new Location(this.x - 1, this.y);
            case Direction.RIGHT:
                return new Location(this.x + 1, this.y);
            case Direction.UP_LEFT:
                return new Location(this.x - 1, this.y - 1);
            case Direction.UP_RIGHT:
                return new Location(this.x + 1, this.y - 1);
            case Direction.DOWN_LEFT:
                return new Location(this.x - 1, this.y + 1);
            case Direction.DOWN_RIGHT:
                return new Location(this.x + 1, this.y + 1);
        }
    }

    toString() {
        return `(${this.x}, ${this.y})`;
    }
}

export class Grid<T extends { value: string | number }> {
    constructor(
        private readonly grid: T[][]
    ) {
    }

    locationOf(value: T) : Location | null {
        for (let y = 0; y < this.grid.length; y++) {
            for (let x = 0; x < this.grid[y].length; x++) {
                if (this.grid[y][x].value == value.value) {
                    return new Location(x, y);
                }
            }
        }

        return null;
    }

    valueOf(location: Location) : T | null {
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
}