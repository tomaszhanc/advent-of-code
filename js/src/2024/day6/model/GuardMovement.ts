import {Grid} from "../../../shared/grid/Grid";
import {GuardPosition} from "./GuardPosition";

export const GuardMovement = {
    nextMove: (position: GuardPosition, map: Grid<string>): GuardPosition | null => {
        let guardPosition = position;

        for (let i = 0; i < 3; i++) {
            const nextPosition = guardPosition.next();

            if (!map.contains(nextPosition.location)) {
                return null;
            }

            if (isObstacle(map.valueOf(nextPosition.location))) {
                guardPosition = guardPosition.turnRight()
                continue;
            }

            return nextPosition;
        }

        throw new Error('Guard is stuck');
    }
}

const isObstacle = (value: string) => value === '#';