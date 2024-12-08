import {readPuzzleInput} from "../../shared/Input";
import {uniqueLocationsWithAntinodes} from "./solution/part1";
import {part2} from "./solution/part2";
import {Stopwatch} from "../../shared/Stopwatch";

const stopwatch = new Stopwatch();
const input = readPuzzleInput('2024/day8.txt');

stopwatch.start('part-1')
console.log('Part 1: ', uniqueLocationsWithAntinodes(input));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');

stopwatch.start('part-2')
console.log('Part 2: ', part2(input));
stopwatch.stop('part-2');
console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');