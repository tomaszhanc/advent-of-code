import {Stopwatch} from "../shared/utils/Stopwatch.js";
import {readPuzzleInput} from "../shared/read.input.js";
import {part1} from "./day20/day20.js";

const stopwatch = new Stopwatch();
let input = readPuzzleInput('2024/day20.txt');

input = `
###############
#...#...#.....#
#.#.#.#.#.###.#
#S#...#.#.#...#
#######.#.#.###
#######.#.#...#
#######.#.###.#
###..E#...#...#
###.#######.###
#...###...#...#
#.#####.#.###.#
#.#...#.#.#...#
#.#.#.#.#.#.###
#...#...#...###
###############
`;

stopwatch.start('part-1')
console.log('Result: ', part1(100, input));
stopwatch.stop('part-1');
console.log('Time: ', stopwatch.result('part-1').toFixed(2), 'ms\n');