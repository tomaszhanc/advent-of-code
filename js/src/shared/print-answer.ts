import { performance } from 'perf_hooks';
import {Input, readPuzzleInput} from "./input";

export const printAnswer = (inputRelativePath: string, solver: (input: Input) => number): void => {
    const startTime = performance.now();
    const input = readPuzzleInput(inputRelativePath);
    const answer = solver(input);
    const endTime = performance.now();

    console.log(`Answer:`, answer);
    console.log((endTime - startTime).toFixed(2), `milliseconds`);
}
