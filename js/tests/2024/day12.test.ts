import {readPuzzleInput} from "../../src/shared/read.input";
import {describe, expect, it} from "vitest";
import {part1, part2} from "../../src/2024/day12/day12.js";

const input1 = `
AAAA
BBCD
BBCC
EEEC
`;
const input2 = `
OOOOO
OXOXO
OOOOO
OXOXO
OOOOO
`;
const input3 = `
RRRRIICCFF
RRRRIICCCF
VVRRRCCFFF
VVRCCCJFFF
VVVVCJJCFE
VVIVCCJJEE
VVIIICJJEE
MIIIIIJJEE
MIIISIJEEE
MMMISSJEEE
`;
const input4 = `
EEEEE
EXXXX
EEEEE
EXXXX
EEEEE
`;
const input5 = `
AAAAAA
AAABBA
AAABBA
ABBAAA
ABBAAA
AAAAAA
`;
const input = readPuzzleInput('2024/day12.txt')

describe('AoC 2024, Day 12, Part 1', () => {
    it('checks the example #1', () => {
        expect(part1(input1)).toBe(140)
    })

    it('checks the example #2', () => {
        expect(part1(input2)).toBe(772)
    })

    it('checks the example #3', () => {
        expect(part1(input3)).toBe(1930)
    })

    it('checks the input', () => {
        expect(part1(input)).toBe(1387004)
    })
});

describe('AoC 2024, Day 12, Part 2', () => {
    it('checks the example #1', () => {
        expect(part2(input1)).toBe(80)
    })

    it('calculates price of the fence for the garden #2 with discount', () => {
        expect(part2(input2)).toBe(436)
    })

    it('calculates price of the fence for the garden #4 with discount', () => {
        expect(part2(input4)).toBe(236)
    })

    it('calculates price of the fence for the garden #5 with discount', () => {
        expect(part2(input5)).toBe(368)
    })

    it('calculates price of the fence for the garden #3 with discount', () => {
        expect(part2(input3)).toBe(1206)
    })

    it('checks the input', () => {
        expect(part2(input)).toBe(844198)
    })
});
