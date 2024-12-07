import {readPuzzleInput} from "../../shared/Input";
import {parsePuzzleInput} from "./solution/parsePuzzleInput";
import {tilesVisitedByGuard} from "./solution/part1";
import {obstaclesToLoopTheGuard} from "./solution/part2";
import {Stopwatch} from "../../shared/Stopwatch";

const stopwatch = new Stopwatch();
const [guardPosition, map] = parsePuzzleInput(readPuzzleInput('2024/day6.txt'));

stopwatch.start('part-1')
console.log('Part 1: ', tilesVisitedByGuard(guardPosition, map));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');

stopwatch.start('part-2')
console.log('Part 2: ', obstaclesToLoopTheGuard(guardPosition, map));
stopwatch.stop('part-2');
console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');