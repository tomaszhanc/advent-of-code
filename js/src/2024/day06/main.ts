import {readPuzzleInput} from "../../shared/Input";
import {parsePuzzleInput} from "./solution/parsePuzzleInput";
import {tilesVisitedByGuard} from "./solution/part1";
import {Stopwatch} from "../../shared/Stopwatch";

const stopwatch = new Stopwatch();
const [guardPosition, map] = parsePuzzleInput(readPuzzleInput('2024/day6_example.txt'));

stopwatch.start('part-1')
const part1 = tilesVisitedByGuard(guardPosition, map);
stopwatch.stop('part-1');

stopwatch.start('part-2')
const part2 = 0; // tilesVisitedByGuard(guardPosition, map);
stopwatch.stop('part-2');

console.log('Part 1: ', part1);
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');
console.log('Part 1: ', part2);
console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');