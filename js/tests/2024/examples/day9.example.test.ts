import {calculateCheckSumOfCompactedByBlockMemory, calculateCheckSumOfCompactedByBlockFile} from "../../../src/2024/day9/solution/solution";
import {describe, expect, it} from "vitest";
import {diskMapToMemory} from "../../../src/2024/day9/solution/disk";

const input = `2333133121414131402`;

describe('AoC 2024, Day 9, Example', () => {
    it('expands disk map into memory blocks', () => {
        expect(diskMapToMemory(input).join('')).toBe('00...111...2...333.44.5555.6666.777.888899')
    });

    it('calculates check sum of compacted by block memory', () => {
        expect(calculateCheckSumOfCompactedByBlockMemory(input)).toBe(1928)
    })

    it('calculates check sum of compacted by file memory', () => {
        expect(calculateCheckSumOfCompactedByBlockFile(input)).toBe(2858)
    })
});