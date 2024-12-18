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

export function isEqual(location: Location, other: Location) : boolean {
    return location.x === other.x && location.y === other.y;
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

export function nextInDirection(location: Location, direction: Direction): Location {
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

export function nextInDirections(location: Location, directions: Direction[]) : Location[] {
    return directions.map(direction => nextInDirection(location, direction));
}

export function sort(locations: Location[]): Location[] {
    const unsorted = Array.from(locations);

    return unsorted.sort((a, b) => a.x - b.x || a.y - b.y);
}

export function unique(locations: Location[]) : Location[] {
    return Array.from(new Set(locations.map(locationAsString))).map(Location.fromString);
}

export function isAdjacent(location: Location, other: Location): boolean {
    return Math.abs(location.x - other.x) <= 1 && Math.abs(location.y - other.y) <= 1;
}