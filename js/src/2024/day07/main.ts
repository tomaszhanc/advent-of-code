import {Stopwatch} from "../../shared/Stopwatch";
import {readPuzzleInput} from "../../shared/Input";
import {totalCalibrationValues} from "./solution/part1";
import {totalCalibrationValuesFor3operators} from "./solution/part2";

const stopwatch = new Stopwatch();
const input = readPuzzleInput('2024/day7.txt');

stopwatch.start('part-1')
console.log('Part 1: ', totalCalibrationValues(input));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');

stopwatch.start('part-2')
console.log('Part 2: ', totalCalibrationValuesFor3operators(input));
stopwatch.stop('part-2');
console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');