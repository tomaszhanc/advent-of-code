type LogicCircuit = Map<string, Gate>;
type Gate = {
    readonly type: string
    readonly inputA: string,
    readonly inputB: string,
}

/**
 * I used the below function to match circuits connections visually. They should match the below pattern.
 * If it doesn't, I looked for the correct one to swap it.
 *
 * ```
 *   z(n)
 *     XOR ...
 *       XOR x(n) y(n)
 *       OR ...
 *         AND x(n-1) y(n-1)
 *         AND ...
 * ```
 *
 * To speed up the process, I checked in which bytes there is a potential problem by setting inputs:
 * - `x: 111...111`
 * - `y: 000...000`
 *
 * The result supposed to be all `111...111`. The first byte that is not 1 is the one that has a problem.
 *
 * ```
 *   const inputs = new Map<string, number>();
 *   for (let i = 0; i < 45; i++) {
 *       inputs.set('x' + i.toString(10).padStart(2, '0'), 1);
 *       inputs.set('y' + i.toString(10).padStart(2, '0'), 0);
 *   }
 *
 *   let result = evaluate(inputs, circuit).split('').reverse();
 *   for (let i = 0; i < 45; i++) {
 *       if (result[i] != '1') {
 *           console.log('First error at byte', i, '\n');
 *           break;
 *       }
 *   }
 * ```
 */
function printAllCircuits(circuit: LogicCircuit) {
    for (let i = 0; i < 45; i++) {
        const index = 'z' + i.toString(10).padStart(2, '0');
        console.log(index);
        printCircuit(index, circuit);
    }
}

function printCircuit(output: string, circuit: LogicCircuit, offset: number = 0) {
    if (offset > 2) {
        return;
    }

    const a = circuit.get(output);
    if (a === undefined) {
        return;
    }

    const padding = ' '.repeat(offset * 2);
    console.log(`${padding}${a.type} ${a.inputA} ${a.inputB} -> ${output}`);

    const next = [a.inputA, a.inputB].sort((a, b) => circuit.get(b)?.type.localeCompare(circuit.get(a)?.type ?? '') ?? 0);

    printCircuit(next[0], circuit, offset + 1);
    printCircuit(next[1], circuit, offset + 1);
}
