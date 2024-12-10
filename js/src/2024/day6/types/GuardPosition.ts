import {Location} from "../../../shared/grid/Location";
import {Direction} from "../../../shared/grid/Direction";

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
            Location.nextInDirection(position.location, position.direction),
            position.direction
        );
    },

    turnRight(position: GuardPosition): GuardPosition {
        return GuardPosition.create(
            position.location,
            Direction.rotateClockwise(position.direction),
        );
    },

    asString(position: GuardPosition): string {
        return Location.asString(position.location) + '-d' + position.direction;
    }
}