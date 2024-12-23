import {combinations} from "../../../shared/utils/generator.utils";
import {parsePuzzleInput} from "./_parsePuzzleInput";
import {isEquationValid} from "../types/Equation";

export function totalCalibrationValues(input: string, operators: string[]): number {
    const equations = parsePuzzleInput(input);

    let total = 0;

    for (let i = 0; i < equations.length; i++) {
        const combos = combinations(operators, equations[i].numbers.length);

        for (let j = 0; j < combos.length; j++) {
            if (isEquationValid(equations[i], combos[j])) {
                total += equations[i].testValue;
                break;
            }
        }
    }

    return total;
}