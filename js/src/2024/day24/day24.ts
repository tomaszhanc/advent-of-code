import {Queue} from "../../shared/struct/Queue.js";

export function part1(input: string): number {
    const [inputs, circuit] = parsePuzzleInput(input);

    return parseInt(evaluate(inputs, circuit), 2);
}

export function part2(input: string, swaps: [string, string][]): number {
    let [inputs, circuit] = parsePuzzleInput(input);

    for (const [a, b] of swaps) {
        circuit = swap(a, b, circuit);
    }

    return parseInt(evaluate(inputs, circuit), 2);
}

type LogicCircuit = Map<string, Gate>;
type Inputs = Map<string, number>;
type Gate = {
    readonly type: string
    readonly inputA: string,
    readonly inputB: string,
}

function parsePuzzleInput(input: string) : [Inputs, LogicCircuit] {
    const [wiresData, gatesData] = input.trim().split('\n\n');

    const wires = new Map(wiresData.split('\n').map(wire => {
        const matches = wire.match(/([a-z0-9]{3}): ([01])/);
        if (matches === null) {
            throw new Error('Invalid input');
        }

        return [matches[1], +matches[2]];
    }));

    const gates = new Map(gatesData.split('\n').map(gate => {
        const matches = gate.match(/([a-z0-9]{3}) (AND|XOR|OR) ([a-z0-9]{3}) -> ([a-z0-9]{3})/);
        if (matches === null) {
            throw new Error('Invalid input');
        }

        const [inputA, inputB] = [matches[1], matches[3]].sort()

        return [matches[4], {type: matches[2], inputA: inputA, inputB: inputB}];
    }));

    return [wires, gates];
}

function evaluate(inputs: Inputs, circuit: LogicCircuit) : string {
    const outputs = new Map(inputs);

    const queue = new Queue<[string, Gate]>();
    queue.enqueue(...circuit.entries());

    while (!queue.isEmpty()) {
        const [output, current] = queue.dequeue();

        if (!knowAllInputs(current, outputs)) {
            queue.enqueue([output, current]);
            continue;
        }

        outputs.set(output, getOutput(current, outputs));
    }

    return toBinaryString(outputs);
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

function swap(a: string, b: string, circuit: LogicCircuit): LogicCircuit {
    const newCircuit = new Map(circuit.entries());

    const gateA = circuit.get(a);
    const gateB = circuit.get(b);

    if (gateA === undefined || gateB === undefined) {
        throw new Error('Invalid inputs');
    }

    newCircuit.set(b, gateA);
    newCircuit.set(a, gateB);

    return newCircuit;
}

const toBinaryString = (inputs: Inputs) => Array.from(inputs.entries())
    .filter(([wire, _]) => wire.startsWith('z'))
    .sort(([wireA, _], [wireB, __]) => wireB.localeCompare(wireA))
    .map(([_, value]) => value)
    .join('');