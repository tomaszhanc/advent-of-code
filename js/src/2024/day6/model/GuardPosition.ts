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
            this.location.nextIn(this.direction),
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
        return this.location.toString() + '-d' + this.direction;
    }
}
