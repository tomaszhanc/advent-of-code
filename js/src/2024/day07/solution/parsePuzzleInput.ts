import {Input} from "../../../shared/Input";
import {Equation} from "../model/Equation";

export function parsePuzzleInput(input: Input) : Equation[] {
    return input.lines().map(line => {
        const [testValue, numbers] = line.split(':');

        return new Equation(
            Number(testValue.trim()),
            numbers.trim().split(' ').map(Number)
        );
    });
}