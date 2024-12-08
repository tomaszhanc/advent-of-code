import {Stopwatch} from "../../shared/Stopwatch";
import {readPuzzleInput} from "../../shared/Input";
import {findAntinodes} from "./solution/findAntinodes";
import {findResonantHarmonicAntinodes} from "./solution/findResonantHarmonicAntinodes";
import {countAntinodesInUniqueLocations} from "./solution/countAntinodesInUniqueLocations";

const stopwatch = new Stopwatch();
const input = readPuzzleInput('2024/day8.txt');

stopwatch.start('part-1')
console.log('Part 1: ', countAntinodesInUniqueLocations(findAntinodes, input));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');

stopwatch.start('part-2')
console.log('Part 2: ', countAntinodesInUniqueLocations(findResonantHarmonicAntinodes, input));
stopwatch.stop('part-2');
console.log('Time: ', stopwatch.result('part-2').toFixed(2), 'ms');