import {Equation} from "../types/Equation";
import {readByLine} from "../../../shared/read.input";

export function parsePuzzleInput(input: string) : Equation[] {
    return readByLine(input).map(line => {
        const [testValue, numbers] = line.split(':');

        return Equation.create(
            +testValue.trim(),
            numbers.trim().split(' ').map(Number)
        );
    });
}