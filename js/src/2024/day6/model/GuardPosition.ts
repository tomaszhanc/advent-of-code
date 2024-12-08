import {Location} from "../../../shared/grid/Location";
import {Direction} from "../../../shared/grid/Direction";

export class GuardPosition {
    constructor(
        public readonly location: Location,
        private readonly direction: Direction
    ) {
    }

    public next(): GuardPosition {
        return new GuardPosition(
            Location.nextInDirection(this.location, this.direction),
            this.direction
        );
    }

    public turnRight() : GuardPosition {
        return new GuardPosition(
            this.location,
            Direction.rotateClockwise(this.direction),
        );
    }

    public toString() : string {
        return Location.asString(this.location) + '-d' + this.direction;
    }
}
