import {GuardPosition} from "../types/GuardPosition";
import {Grid} from "../../../shared/grid/Grid";
import {Direction} from "../../../shared/grid/Direction";
import {readByLine} from "../../../shared/read.input";

export function parsePuzzleInput(input: string): [GuardPosition, Grid<string>] {
    const map = Grid.fromArray(
        readByLine(input).map(line => line.split('')),
        '.'
    );
    const guardLocation = map.locationOf('^');

    if (guardLocation === null) {
        throw new Error('Guard not found');
    }

    const guardPosition = GuardPosition.create(guardLocation, Direction.UP);

    return [guardPosition, map];
}