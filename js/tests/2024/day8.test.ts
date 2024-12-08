import {readPuzzleInput} from "../../src/shared/Input";
import {uniqueLocationsWithAntinodes} from "../../src/2024/day8/solution/part1";
import {part2} from "../../src/2024/day8/solution/part2";
import {describe, expect, it} from 'vitest'

const input = readPuzzleInput('2024/day8.txt')

describe('AoC 2024, Day 8', () => {
    it('detects unique locations with antinodes', () => {
        expect(uniqueLocationsWithAntinodes(input)).toBe(344)
    })

    it('detects unique locations of antinodes with resonant harmonic effects', () => {
        expect(part2(input)).toBe(1182)
    })
});