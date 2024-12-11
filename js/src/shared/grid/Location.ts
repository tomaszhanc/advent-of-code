import {Direction} from "./Direction";
import {Distance} from "./Distance";

export type Location = {
    readonly x: number,
    readonly y: number
}

export const Location = {
    fromString(location: string): Location {
        const [x, y] = location.split(',').map(Number);
        return {x, y};
    },
}

export function locationAsString(location: Location): string {
    return `${location.x},${location.y}`;
}

export function distanceBetween(location: Location, other: Location): Distance {
    return { dX: location.x - other.x, dY: location.y - other.y };
}

export function nextByDistance(location: Location, distance: Distance): Location {
    return { x: location.x + distance.dX, y: location.y + distance.dY };
}

export function nextByDirection(location: Location, direction: Direction): Location {
    const directionMap = {
        [Direction.UP_LEFT]:    {dX: -1, dY: -1},
        [Direction.UP]:         {dX: 0,  dY: -1},
        [Direction.UP_RIGHT]:   {dX: 1,  dY: -1},
        [Direction.RIGHT]:      {dX: 1,  dY:  0},
        [Direction.DOWN_RIGHT]: {dX: 1,  dY:  1},
        [Direction.DOWN]:       {dX: 0,  dY:  1},
        [Direction.DOWN_LEFT]:  {dX: -1, dY:  1},
        [Direction.LEFT]:       {dX: -1, dY:  0},
    };

    return nextByDistance(location, directionMap[direction]);
}