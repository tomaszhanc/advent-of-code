import {Queue} from "../../shared/struct/Queue.js";

export function part1(input: string): number {
    const [inputs, gates] = parsePuzzleInput(input);

    const binaryString = Array.from(getAllOutputs(inputs, gates).entries())
        .filter(([wire, _]) => wire.startsWith('z'))
        .sort(([wireA, _], [wireB, __]) => wireB.localeCompare(wireA))
        .map(([_, value]) => value)
        .join('');

    return parseInt(binaryString, 2);
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

type Gate = {
    readonly type: string
    readonly output: string;
    readonly inputA: string,
    readonly inputB: string,
}

function parsePuzzleInput(input: string) : [Map<string, number>, Gate[]] {
    const [wiresData, gatesData] = input.trim().split('\n\n');

    const wires = new Map(wiresData.split('\n').map(wire => {
        const matches = wire.match(/([a-z0-9]{3}): ([01])/);
        if (matches === null) {
            throw new Error('Invalid input');
        }

        return [matches[1], +matches[2]];
    }));

    const gates = gatesData.split('\n').map(gate => {
        const matches = gate.match(/([a-z0-9]{3}) (AND|XOR|OR) ([a-z0-9]{3}) -> ([a-z0-9]{3})/);
        if (matches === null) {
            throw new Error('Invalid input');
        }

        return {type: matches[2], output: matches[4], inputA: matches[1], inputB: matches[3]};
    });

    return [wires, gates];
}

function getAllOutputs(inputs: Map<string, number>, gates: Gate[]) : Map<string, number> {
    const outputs = new Map(inputs);

    const queue = new Queue<Gate>();
    queue.enqueue(...gates);

    while (!queue.isEmpty()) {
        const current = queue.dequeue();

        if (!knowAllInputs(current, outputs)) {
            queue.enqueue(current);
            continue;
        }

        outputs.set(current.output, getOutput(current, outputs));
    }

    return outputs;
}

function knowAllInputs(gate: Gate, inputs: Map<string, number>) : boolean {
    return inputs.has(gate.inputA) && inputs.has(gate.inputB);
}

function getOutput(gate: Gate, inputs: Map<string, number>) : number {
    if (!knowAllInputs(gate, inputs)) throw new Error('Not all inputs are known');

    switch (gate.type) {
        case 'AND': return inputs.get(gate.inputA)! & inputs.get(gate.inputB)!;
        case 'OR':  return inputs.get(gate.inputA)! | inputs.get(gate.inputB)!;
        case 'XOR': return inputs.get(gate.inputA)! ^ inputs.get(gate.inputB)!;
    }

    throw new Error('Invalid gate type');
}