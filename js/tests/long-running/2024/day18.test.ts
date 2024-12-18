import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../../src/shared/read.input";
import {part2} from "../../../src/2024/day18/day18";

const input = readPuzzleInput('2024/day18.txt');

describe('AoC 2024, Day 18', () => {
    it('part 2', () => {
        expect(part2(input, 71, 1024)).toBe('56,27')
    })
});