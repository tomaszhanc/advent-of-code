import {Location} from "../../../shared/grid/Location";
import {Direction} from "../../../shared/grid/Direction";
import {Grid} from "../../../shared/grid/Grid";

export class GuardPosition {
    constructor(
        public readonly position: Location,
        public readonly direction: Direction
    ) {
    }

    public nextMove(map: Grid<string>): GuardPosition | null {
        let currentDirection = this.direction;

        for (let i = 0; i < 3; i++) {
            const nextPosition = this.position.next(currentDirection);
            const nextPositionType = map.valueOf(nextPosition);

            if (nextPositionType === null) {
                return null;
            }

            if (isObstacle(nextPositionType)) {
                currentDirection = Direction.rotateClockwise(currentDirection);
                continue;
            }

            return new GuardPosition(nextPosition, currentDirection);
        }

        throw new Error('Guard is stuck');
    }

    public toString() : string {
        return this.position.toString() + '-d' + this.direction;
    }
}

const isObstacle = (value: string) => value === '#';