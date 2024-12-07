import {Input, readPuzzleInput} from "../../shared/Input";
import {parsePuzzleInput} from "./solution/parsePuzzleInput";
import {totalCalibrationValues} from "./solution/part1";
import {part2} from "./solution/part2";
import {Stopwatch} from "../../shared/Stopwatch";

const stopwatch = new Stopwatch();
const equations = parsePuzzleInput(readPuzzleInput('2024/day7.txt'));
// const equations = parsePuzzleInput(new Input(`190: 10 19
// 3267: 81 40 27
// 83: 17 5
// 156: 15 6
// 7290: 6 8 6 15
// 161011: 16 10 13
// 192: 17 8 14
// 21037: 9 7 18 13
// 292: 11 6 16 20`));

stopwatch.start('part-1')
console.log('Part 1: ', totalCalibrationValues(equations));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');

stopwatch.start('part-2')
console.log('Part 2: ', part2());
stopwatch.stop('part-2');
console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');