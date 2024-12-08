import {readByLine} from "../../../shared/read.input";
import {Grid} from "../../../shared/grid/Grid";

export function parsePuzzleInput(input: string) {
    return Grid.fromArray(
        readByLine(input).map(line => line.split('')),
        '.'
    );
}