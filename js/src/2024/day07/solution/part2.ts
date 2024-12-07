import {Input} from "../../../shared/Input";
import {generateAllCombinations} from "../../../shared/utils/generator.utils";
import {parsePuzzleInput} from "./parsePuzzleInput";

export function totalCalibrationValuesFor3operators(input: Input): number {
    const equations = parsePuzzleInput(input);

    let total = 0;

    for (let i = 0; i < equations.length; i++) {
        const combinations = generateAllCombinations(equations[i].numbers.length, ['+', '*', '||']);

        for (let j = 0; j < combinations.length; j++) {
            if (equations[i].isValid(combinations[j])) {
                total += equations[i].testValue;
                break;
            }
        }
    }

    return total;
}