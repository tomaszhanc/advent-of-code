import {Grid} from "../../../shared/grid/Grid";
import {Direction} from "../../../shared/grid/Direction";
import {GuardPosition} from "../types/GuardPosition";

export function parsePuzzleInput(input: string): [GuardPosition, Grid] {
    const map = Grid.fromString(input);
    const guardLocation = map.firstPositionOf('^');

    if (guardLocation === null) {
        throw new Error('Guard not found');
    }

    return [
        { location: guardLocation, direction: Direction.UP },
        map
    ];
}