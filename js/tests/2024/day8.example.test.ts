import {findAntinodes} from "../../src/2024/day8/solution/findAntinodes";
import {findResonantHarmonicAntinodes} from "../../src/2024/day8/solution/findResonantHarmonicAntinodes";
import {countAntinodesInUniqueLocations} from "../../src/2024/day8/solution/countAntinodesInUniqueLocations";
import {describe, expect, it} from 'vitest'

const input = `
............
........a...
.....a......
.......a....
....a.......
......A.....
............
............
........A...
.........A..
............
............
`;

describe('AoC 2024, Day 8, Example', () => {
    it('detects unique locations with antinodes', () => {
        expect(countAntinodesInUniqueLocations(findAntinodes, input)).toBe(14);
    })

    it('detects unique locations of antinodes with resonant harmonic effects', () => {
        expect(countAntinodesInUniqueLocations(findResonantHarmonicAntinodes, input)).toBe(34)
    })
});