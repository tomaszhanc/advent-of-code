import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day14/day14";

const example = `
p=0,4 v=3,-3
p=6,3 v=-1,-3
p=10,3 v=-1,2
p=2,0 v=2,-1
p=0,0 v=1,3
p=3,0 v=-2,-2
p=7,6 v=-1,-3
p=3,0 v=-1,-2
p=9,3 v=2,3
p=7,3 v=-1,2
p=2,4 v=2,-3
p=9,5 v=-3,-3
`;
const input = readPuzzleInput('2024/day14.txt');

describe('AoC 2024, Day 14, Part 1', () => {
    it('checks the example', () => {
        expect(part1(11, 7, example)).toBe(12)
    })

    it('check the input', () => {
        expect(part1(101, 103, input)).toBe(231019008)
    })
});

describe('AoC 2024, Day 14, Part 2', () => {
    it('checks the input', () => {
        expect(part2(101, 103, input)).toBe(8280)
    })
});