import {Equation} from "../model/Equation";
import {readByLine} from "../../../shared/Input";

export function parsePuzzleInput(input: string) : Equation[] {
    return readByLine(input).map(line => {
        const [testValue, numbers] = line.split(':');

        return new Equation(
            +testValue.trim(),
            numbers.trim().split(' ').map(Number)
        );
    });
}