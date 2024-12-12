import {numberOfStonesAfterBlinks} from "../../src/2024/day11/numberOfStonesAfterBlinks";
import { describe, expect, it } from "vitest";

const input = `125 17`;

describe('AoC 2024, Day 11, Example', () => {
  it('number of stones after 25 blinks', () => {
    expect(numberOfStonesAfterBlinks(25, input)).toBe(55312)
  })

  it('number of stones after 75 blinks', () => {
    expect(numberOfStonesAfterBlinks(75, input)).toBe(65601038650482)
  })
});