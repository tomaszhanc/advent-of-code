import {Input} from "../../src/shared/Input";
import {totalCalibrationValues} from "../../src/2024/day07/solution/part1";
import { describe, expect, it } from 'vitest'

const input = new Input(`
190: 10 19
3267: 81 40 27
83: 17 5
156: 15 6
7290: 6 8 6 15
161011: 16 10 13
192: 17 8 14
21037: 9 7 18 13
292: 11 6 16 20
`);

describe('AoC 2024, Day 7, Example', () => {
  it('sums all valid test values that are possible to calculate using operators "+" and "*"', () => {
    expect(totalCalibrationValues(input, ['+', '*'])).toBe(3749)
  })

  it('sums all valid test values that are possible to calculate using operators "+", "*" and "||"', () => {
    expect(totalCalibrationValues(input, ['+', '*', '||'])).toBe(11387)
  })
});