"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const Input_1 = require("../../src/shared/Input");
const parsePuzzleInput_1 = require("../../src/2024/day06/solution/parsePuzzleInput");
const part1_1 = require("../../src/2024/day06/solution/part1");
const part2_1 = require("../../src/2024/day06/solution/part2");
const vitest_1 = require("vitest");
const [guardPosition, map] = (0, parsePuzzleInput_1.parsePuzzleInput)((0, Input_1.readPuzzleInput)('2024/day6.txt'));
(0, vitest_1.describe)('Input: 2024, Day 6', () => {
    (0, vitest_1.it)('calculates tiles visited by guard to escape the map', () => {
        (0, vitest_1.expect)((0, part1_1.tilesVisitedByGuard)(guardPosition, map)).toBe(4982);
    });
    (0, vitest_1.it)('calculates number of possible obstacles to plant on the map to trap the guard', () => {
        (0, vitest_1.expect)((0, part2_1.obstaclesToLoopTheGuard)(guardPosition, map)).toBe(1663);
    });
});
//# sourceMappingURL=day06.test.js.map