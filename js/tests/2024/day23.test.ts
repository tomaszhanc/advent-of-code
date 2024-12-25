import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {part1, part2} from "../../src/2024/day23/day23";

const example = `
kh-tc
qp-kh
de-cg
ka-co
yn-aq
qp-ub
cg-tb
vc-aq
tb-ka
wh-tc
yn-cg
kh-ub
ta-co
de-co
tc-td
tb-wq
wh-td
ta-ka
td-qp
aq-cg
wq-ub
ub-vc
de-ta
wq-aq
wq-vc
wh-yn
ka-de
kh-ta
co-tc
wh-qp
tb-vc
td-yn
`;
const input = readPuzzleInput('2024/day23.txt');

describe('AoC 2024, Day 23, Part 1', () => {
    it('checks the example', () => {
        expect(part1(example)).toBe(7)
    })

    it('checks the input', () => {
        expect(part1(input)).toBe(1194)
    })
});

describe('AoC 2024, Day 23, Part 2', () => {
    it('checks the example', () => {
        expect(part2(example)).toBe('co,de,ka,ta')
    })

    it('checks the input', () => {
        expect(part2(input)).toBe('bd,bu,dv,gl,qc,rn,so,tm,wf,yl,ys,ze,zr')
    })
});