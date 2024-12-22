import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day20/day20";

const example = `
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

const input = readPuzzleInput('2024/day20.txt');

describe('AoC 2024, Day X, Part 1', () => {
    const cheatSpanPicoseconds = 2;

    it('checks the example', () => {
        const saveAtLeastPicoseconds = 1;
        expect(part1(example, cheatSpanPicoseconds, saveAtLeastPicoseconds)).toBe(44)
    })

    it('check the input', () => {
        const saveAtLeastPicoseconds = 100;
        expect(part1(input, cheatSpanPicoseconds, saveAtLeastPicoseconds)).toBe(1490)
    })
});

describe('AoC 2024, Day X, Part 2', () => {
    const cheatSpanPicoseconds = 20;

    it('checks the example', () => {
        const saveAtLeastPicoseconds = 50;
        expect(part1(example, cheatSpanPicoseconds, saveAtLeastPicoseconds)).toBe(285)
    })

    it('checks the input', () => {
        const saveAtLeastPicoseconds = 100;
        expect(part1(input, cheatSpanPicoseconds, saveAtLeastPicoseconds)).toBe(-1)
    })
});