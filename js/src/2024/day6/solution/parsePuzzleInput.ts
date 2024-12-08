import {GuardPosition} from "../model/GuardPosition";
import {Grid} from "../../../shared/grid/Grid";
import {Direction} from "../../../shared/grid/Direction";
import {readByLine} from "../../../shared/Input";

export function parsePuzzleInput(input: string): [GuardPosition, Grid<string>] {
    const map = Grid.fromArray(
        readByLine(input).map(line => line.split('')),
        '.'
    );
    const guardLocation = map.locationOf('^');

    if (guardLocation === null) {
        throw new Error('Guard not found');
    }

    const guardPosition = new GuardPosition(guardLocation, Direction.UP);

    return [guardPosition, map];
}