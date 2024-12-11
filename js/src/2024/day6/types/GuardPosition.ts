import {Location, locationAsString, nextByDirection} from "../../../shared/grid/Location";
import {Direction, rotateClockwise} from "../../../shared/grid/Direction";
import {Grid} from "../../../shared/grid/Grid";

export type GuardPosition = {
    readonly location: Location,
    readonly direction: Direction,
}

export const GuardPosition = {
    create(location: Location, direction: Direction): GuardPosition {
        return {location, direction};
    },
}

export function guardPositionAsString(position: GuardPosition): string {
    return locationAsString(position.location) + '-d' + position.direction;
}

export function turnRight(position: GuardPosition): GuardPosition {
    return {
        location: position.location,
        direction: rotateClockwise(position.direction)
    };
}

export function nextGuardPosition(position: GuardPosition): GuardPosition {
    return {
        location: nextByDirection(position.location, position.direction),
        direction: position.direction
    };
}

export function nextGuardPositionOnMap(position: GuardPosition, map: Grid<string>): GuardPosition | null {
    let guardPosition = position;

    for (let i = 0; i < 3; i++) {
        const nextPosition = nextGuardPosition(guardPosition);

        if (!map.hasInBounds(nextPosition.location)) {
            return null;
        }

        if (isObstacle(map.valueOf(nextPosition.location))) {
            guardPosition = turnRight(guardPosition)
            continue;
        }

        return nextPosition;
    }

    throw new Error('Guard is stuck');
}

const isObstacle = (value: string) => value === '#';