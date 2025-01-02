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

export function part1(input: string): string {
    let [register, program] = parsePuzzleInput(input);

    return runProgram(program, register).output;
}

export function part2(input: string): number {
    const [register, program] = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) : [Register, number[]] {
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

function interpretInstruction(instruction: number, operand: number, register: Register) : Result {
    let newRegister = { A:register.A, B:register.B, C:register.C };
    let newInstructionPointer = null, output = null;

    switch (instruction) {
        case 0:
            const adv = register.A >> combo(operand, register);
            newRegister.A = adv;
            break;

        case 1:
            const bxl = register.B ^ operand
            newRegister.B = bxl;
            break;

        case 2:
            // fixme keeping only 3 lowest bits?
            const bst = combo(operand, register) & 7;
            newRegister.B = bst;
            break;

        case 3:
            const inz = register.A === 0 ? null : operand;
            newInstructionPointer = inz;
            break;

        case 4:
            const bxc = register.B ^ register.C;
            newRegister.B = bxc;
            break;

        case 5:
            output = combo(operand, register) & 7;
            break;

        case 6:
            const bdv = register.A >> combo(operand, register);
            newRegister.B = bdv;
            break

        case 7:
            const cdv = register.A >> combo(operand, register);
            newRegister.C = cdv;
            break;

        default:
            throw new Error('Invalid instruction');
    }

    return { register: newRegister, newInstructionPointer, output };
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