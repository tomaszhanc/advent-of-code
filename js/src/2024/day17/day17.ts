export function part1(input: string): string {
    let [register, program] = parsePuzzleInput(input);

    return runProgram(program, register).output;
}

export function part2(input: string, registerA : number): string {
    let [register, program] = parsePuzzleInput(input);

    return runProgram(program, {...register, A: registerA}).output;
}

type Register = {
    readonly A: number;
    readonly B: number;
    readonly C: number;
}
type Result = {
    readonly register: Register,
    readonly newInstructionPointer: number | null,
    readonly output: number | null
};

function parsePuzzleInput(input: string): [Register, number[]] {
    const lines = input.trim().split('\n')
    const registerAMatches = lines[0].match(/Register A: (\d+)/);
    const registerBMatches = lines[1].match(/Register B: (\d+)/);
    const registerCMatches = lines[2].match(/Register C: (\d+)/);
    const programMatches = lines[4].match(/Program: ([\d,,]+)/);

    if (registerAMatches === null || registerBMatches === null || registerCMatches === null || programMatches === null) {
        throw new Error('Invalid input');
    }

    return [
        { A: +registerAMatches[1], B: +registerBMatches[1], C: +registerCMatches[1] },
        programMatches[1].split(',').map(Number)
    ];
}

export function runProgram(program: number[], register: Register) : { register: Register, output: string } {
    const output : number[] = [];
    let instructionPointer = 0;

    while (instructionPointer < program.length) {
        const result = interpretInstruction(program[instructionPointer], program[instructionPointer+1], register);

        register = result.register;
        instructionPointer = result.newInstructionPointer ?? instructionPointer + 2;

        if (result.output !== null) {
            output.push(result.output);
        }
    }

    return { register, output: output.join(',') };
}

export function interpretInstruction(instruction: number, operand: number, register: Register) : Result {
    let newRegister = { A:register.A, B:register.B, C:register.C };
    let newInstructionPointer = null, output = null;

    switch (instruction) {
        case 0: // adv
            newRegister.A = register.A >> combo(operand, register);
            break;

        case 1: // bxl
            newRegister.B = register.B ^ operand;
            break;

        case 2: // bst
            newRegister.B = combo(operand, register) % 8 ;
            break;

        case 3: // inz
            newInstructionPointer = register.A === 0 ? null : operand;
            break;

        case 4: // bxc
            newRegister.B = register.B ^ register.C;
            break;

        case 5: // out
            output = combo(operand, register) % 8;
            break;

        case 6: // bdv
            newRegister.B = register.A >> combo(operand, register);
            break

        case 7: // cdv
            newRegister.C = register.A >> combo(operand, register);
            break;

        default:
            throw new Error('Invalid instruction');
    }

    return {register: newRegister, newInstructionPointer, output};
}

function combo(operand: number, register: Register) {
    switch (operand) {
        case 0:
        case 1:
        case 2:
        case 3: return operand;
        case 4: return register.A;
        case 5: return register.B;
        case 6: return register.C;
        default: throw new Error(`Invalid operand: ${operand}`);
    }
}