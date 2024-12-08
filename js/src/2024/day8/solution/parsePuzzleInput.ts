import {readByLine} from "../../../shared/Input";
import {Grid} from "../../../shared/grid/Grid";

export function parsePuzzleInput(input: string) {
    return Grid.fromArray(
        readByLine(input).map(line => line.split('')),
        '.'
    );
}