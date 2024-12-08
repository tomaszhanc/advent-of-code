import {Direction} from "./Direction";
import {Distance} from "./Distance";

export type Location = {
    readonly x: number,
    readonly y: number
}

export const Location = {
    create(x: number, y: number): Location {
        return {x, y};
    },

    asString(location: Location): string {
        return `${location.x},${location.y}`;
    },

    fromString(location: string): Location {
        const [x, y] = location.split(',').map(Number);
        return Location.create(x, y);
    },

    distanceBetween(location: Location, other: Location): Distance {
        return Distance.create(location.x - other.x, location.y - other.y);
    },

    nextByDistance(location: Location, distance: Distance): Location {
        return Location.create(location.x - distance.diffX, location.y - distance.diffY);
    },

    nextInDirection(location: Location, direction: Direction): Location {
        switch (direction) {
            case Direction.UP:
                return Location.create(location.x, location.y - 1);
            case Direction.DOWN:
                return Location.create(location.x, location.y + 1);
            case Direction.LEFT:
                return Location.create(location.x - 1, location.y);
            case Direction.RIGHT:
                return Location.create(location.x + 1, location.y);
            case Direction.UP_LEFT:
                return Location.create(location.x - 1, location.y - 1);
            case Direction.UP_RIGHT:
                return Location.create(location.x + 1, location.y - 1);
            case Direction.DOWN_LEFT:
                return Location.create(location.x - 1, location.y + 1);
            case Direction.DOWN_RIGHT:
                return Location.create(location.x + 1, location.y + 1);
        }
    }
}