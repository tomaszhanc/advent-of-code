import {Grid} from "../../../shared/grid/Grid";
import {readByLine} from "../../../shared/read.input";

export function parsePuzzleInput(input: string) : Grid<number> {
    return Grid.fromArray(readByLine(input).map(line => line.split('').map(Number)));
}