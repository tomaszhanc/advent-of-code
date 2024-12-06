import * as Day01 from './2024/day01.js';
import { readPuzzleInput } from './shared/input';

const day = parseInt(process.argv[2], 10);
if (isNaN(day)) {
    console.error('Please provide a valid day number');
    process.exit(1);
}

const input = readPuzzleInput(2024, day);

let solutionPart1: number | string | undefined;
let solutionPart2: number | string | undefined;

switch (day) {
    case 1:
        solutionPart1 = Day01.solvePart1(input);
        solutionPart2 = Day01.solvePart2(input);
        break;
    // Add more cases for other days
    default:
        console.error(`No solution found for Day ${day}.`);
        process.exit(1);
}

console.log(`Day ${day} - Part 1:`, solutionPart1);
console.log(`Day ${day} - Part 2:`, solutionPart2);