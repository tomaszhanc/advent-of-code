import {Direction} from "./Direction";

export class Location {
    constructor(
        public readonly x: number,
        public readonly y: number
    ) {
    }

    public next(direction: Direction): Location {
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

    public toString() {
        return `(${this.x}, ${this.y})`;
    }
}
