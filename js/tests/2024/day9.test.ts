import {readPuzzleInput} from "../../src/shared/read.input";
import { describe, expect, it } from "vitest";
import {
    calculateCheckSumOfCompactedByBlockFile,
    calculateCheckSumOfCompactedByBlockMemory
} from "../../src/2024/day9/solution/solution";

const input = readPuzzleInput('2024/day9.txt')

describe('AoC 2024, Day 9', () => {
    it('calculates check sum of compacted hard drive', () => {
        expect(calculateCheckSumOfCompactedByBlockMemory(input)).toBe(6395800119709)
    })

    it('calculates check sum of compacted by file memory', () => {
        expect(calculateCheckSumOfCompactedByBlockFile(input)).toBe(6418529470362)
    })
});