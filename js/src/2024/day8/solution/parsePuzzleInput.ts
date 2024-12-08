import {Input} from "../../../shared/Input";
import {Grid} from "../../../shared/grid/Grid";

export function parsePuzzleInput(input: Input) {
    return Grid.fromArray(
        input.lines().map(line => line.split('')),
        '.'
    );
}