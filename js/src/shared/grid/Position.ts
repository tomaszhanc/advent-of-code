/**
 * I'm experimenting with class Position and type Location
 * for the same concept to see which one I like better.
 */

type Location = {
    readonly x: number,
    readonly y: number
}

export class Position {
    public constructor(
        public readonly x: number,
        public readonly y: number
    ) {
    }

    public static fromString(location: string): Position {
        const [x, y] = location.split(',').map(Number);
        return new Position(x, y);
    }

    public inBounds(start: Location, end: Location) : boolean {
        return this.x >= start.x && this.x <= end.x
            && this.y >= start.y && this.y <= end.y;
    }

    public toString(): string {
        return `${this.x},${this.y}`;
    }
}