import {readPuzzleInput} from "../../src/shared/Input";
import {findAntinodes} from "../../src/2024/day8/solution/findAntinodes";
import {findResonantHarmonicAntinodes} from "../../src/2024/day8/solution/findResonantHarmonicAntinodes";
import {countAntinodesInUniqueLocations} from "../../src/2024/day8/solution/countAntinodesInUniqueLocations";
import {describe, expect, it} from 'vitest'

const input = readPuzzleInput('2024/day8.txt')

describe('AoC 2024, Day 8', () => {
    it('detects unique locations with antinodes', () => {
        expect(countAntinodesInUniqueLocations(findAntinodes, input)).toBe(344);
    })

    it('detects unique locations of antinodes with resonant harmonic effects', () => {
        expect(countAntinodesInUniqueLocations(findResonantHarmonicAntinodes, input)).toBe(1182)
    })
});