import {Stopwatch} from "../../shared/utils/Stopwatch";
import {numberOfStonesAfterBlinks} from "./solution/numberOfStonesAfterBlinks";

const stopwatch = new Stopwatch();
const input = `9694820 93 54276 1304 314 664481 0 4`;

stopwatch.start('part-1')
console.log('Part 1: ', numberOfStonesAfterBlinks(input));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');

// stopwatch.start('part-2')
// console.log('Part 2: ', part2(input));
// stopwatch.stop('part-2');
// console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');