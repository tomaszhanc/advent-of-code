import {Input} from "../../../shared/Input";
import {GuardPosition} from "../model/GuardPosition";
import {Grid} from "../../../shared/grid/Grid";
import {Direction} from "../../../shared/grid/Direction";

export function parsePuzzleInput(input: Input): [GuardPosition, Grid<string>] {
    let map = Grid.fromArray(
        input.lines().map(line => line.split('')),
        '.'
    );
    const guardLocation = map.locationOf('^');

    if (guardLocation === null) {
        throw new Error('Guard not found');
    }

    let guardPosition = new GuardPosition(guardLocation, Direction.UP);

    return [guardPosition, map];
}