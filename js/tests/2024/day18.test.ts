import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day18/day18";

const input = readPuzzleInput('2024/day18.txt');
const example = `
5,4
4,2
4,5
3,0
2,1
6,3
2,4
1,5
0,6
3,3
2,6
5,1
1,2
5,5
2,5
6,5
1,4
0,4
6,4
1,1
6,1
1,0
0,5
1,6
2,0
`;

describe('AoC 2024, Day 18, Example', () => {
    it('part 1', () => {
        expect(part1(example, 7, 12)).toBe(22)
    })

    it('part 2', () => {
        expect(part2(example, 7)).toBe(-1)
    })
});

describe('AoC 2024, Day X', () => {
    it('part 1', () => {
        expect(part1(input, 71, 1024)).toBe(432)
    })

});