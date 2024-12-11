import {Location, locationAsString, nextByDirection} from "../../../shared/grid/Location";
import {Direction, rotateClockwise} from "../../../shared/grid/Direction";

export type GuardPosition = {
    readonly location: Location,
    readonly direction: Direction,
}

export const GuardPosition = {
    create(location: Location, direction: Direction): GuardPosition {
        return {location, direction};
    },

    next(position: GuardPosition): GuardPosition {
        return GuardPosition.create(
            nextByDirection(position.location, position.direction),
            position.direction
        );
    },

    turnRight(position: GuardPosition): GuardPosition {
        return GuardPosition.create(
            position.location,
            rotateClockwise(position.direction),
        );
    },

    asString(position: GuardPosition): string {
        return locationAsString(position.location) + '-d' + position.direction;
    }
}