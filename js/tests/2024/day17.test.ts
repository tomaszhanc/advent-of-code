import {describe, expect, it} from "vitest";
import {readPuzzleInput} from "../../src/shared/read.input";
import {runProgram, part1, part2} from "../../src/2024/day17/day17";

const examplePart1 = `
Register A: 729
Register B: 0
Register C: 0

Program: 0,1,5,4,3,0
`;

const input = readPuzzleInput('2024/day17.txt');

describe('AoC 2024, Day 17, Part 1', () => {
    it('checks the example', () => {
        expect(part1(examplePart1)).toBe('4,6,3,5,6,3,5,2,1,0')
    })

    it('check the input', () => {
        expect(part1(input)).toBe('2,0,4,2,7,0,1,0,3')
    })
});

describe('Check Instructions', () => {
    it('the program sets register B to 1', () => {
        const register = {A: 0, B: 0, C: 9};
        const result = runProgram([2,6], register);

        expect(result.register).eql({...register, B: 1});
        expect(result.output).eql('');
    })

    it('the program outputs 0,1,2', () => {
        const register = {A: 10, B: 0, C: 0};
        const result = runProgram([5,0,5,1,5,4], register);

        expect(result.register).eql(register);
        expect(result.output).eql('0,1,2');
    })

    it('the program outputs 4,2,5,6,7,7,7,7,3,1,0 and leaves 0 in register A', () => {
        const register = {A: 2024, B: 0, C: 0};
        const result = runProgram([0,1,5,4,3,0], register);

        expect(result.register).eql({...register, A: 0});
        expect(result.output).eql('4,2,5,6,7,7,7,7,3,1,0');
    })

    it('the program sets register B to 26', () => {
        const register = {A: 0, B: 29, C: 0};
        const result = runProgram([1,7], register);

        expect(result.register).eql({...register, B: 26});
        expect(result.output).eql('');
    })

    it('the program sets register B to 44354', () => {
        const register = {A: 0, B: 2024, C: 43690};
        const result = runProgram([4,0], register);

        expect(result.register).eql({...register, B: 44354});
        expect(result.output).eql('');
    })
});