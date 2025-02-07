export function find(): number | null {
    const program = [2, 4, 1, 7, 7, 5, 1, 7, 0, 3, 4, 1, 5, 5, 3, 0];

    return doFind(program, 0);
}

function doFind(program: number[], answer: number): number | null {
    if (program.length === 0) {
        return answer;
    }

    for (let t = 0; t < 8; t++) {
        let a = answer << 3 | t; // 0,3
        let b = 0;
        let c = 0;

        b = a % 8;  // 2,4
        b = b ^ 7;  // 1,7
        c = a >> b; // 7,5
        b = b ^ 7;  // 1.7
        b = b ^ c;  // 4,1

        // 5,5
        if (b % 8 === program[program.length - 1]) {
            const sub = doFind(program.slice(0, program.length - 1), a);
            if (sub !== null) return sub;
        }
    }

    return null;
}