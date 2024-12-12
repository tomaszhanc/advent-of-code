import {Stopwatch} from "../../shared/utils/Stopwatch";
import {readPuzzleInput} from "../../shared/read.input";
import {sumRanksOfAllTrailheads, sumScoreOfAllTrailheads} from "./solution/trails";

const stopwatch = new Stopwatch();
const input = readPuzzleInput('2024/day10.txt');

stopwatch.start('part-1')
console.log('Part 1: ', sumScoreOfAllTrailheads(input));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');

stopwatch.start('part-2')
console.log('Part 2: ', sumRanksOfAllTrailheads(input));
stopwatch.stop('part-2');
console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');