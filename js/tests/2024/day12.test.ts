import {readPuzzleInput} from "../../src/shared/read.input";
import {describe, expect, it} from "vitest";
import {calculatePriceOfFence, calculatePriceOfFenceWithDiscount} from "../../src/2024/day12/day12";

const input = readPuzzleInput('2024/day12.txt')

describe('AoC 2024, Day 12', () => {
    it('calculates price of the fence for the garden', () => {
        expect(calculatePriceOfFence(input)).toBe(1387004)
    })
});