import {Grid} from "../../shared/grid/Grid";
import {readByLine} from "../../shared/read.input";

export function parsePuzzleInput(input: string) {
    return Grid.fromArray(readByLine(input).map(line => line.split('')));
}