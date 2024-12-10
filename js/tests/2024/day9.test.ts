import {readPuzzleInput} from "../../src/shared/read.input";
import { describe, expect, it } from "vitest";
import {calculateCheckSumOfCompactedHardDrive} from "../../src/2024/day9/solution/part1";

const input = readPuzzleInput('2024/day9.txt')

describe('AoC 2024, Day 9', () => {
    it('calculates check sum of compacted hard drive', () => {
        expect(calculateCheckSumOfCompactedHardDrive(input)).toBe(6395800119709)
    })
});