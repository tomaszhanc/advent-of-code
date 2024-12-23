import {readPuzzleInput} from "../../../src/shared/read.input";
import {totalCalibrationValues} from "../../../src/2024/day7/solution/totalCalibrationValues";
import {describe, expect, it} from 'vitest'

const input = readPuzzleInput('2024/day7.txt')

describe('AoC 2024, Day 7', () => {
    it('sums all valid test values that are possible to calculate using operators "+" and "*"', () => {
        expect(totalCalibrationValues(input, ['+', '*'])).toBe(28730327770375)
    })

    it('sums all valid test values that are possible to calculate using operators "+", "*" and "*"', () => {
        expect(totalCalibrationValues(input, ['+', '*', '||'])).toBe(424977609625985)
    })
});