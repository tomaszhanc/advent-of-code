import {Grid} from "../../shared/grid/Grid";
import {readByLine} from "../../shared/read.input";

export function part1(input: string): number[] {
    // const _ = parsePuzzleInput(input);
    const secret = +input;

    const next = nextSecretNumber(secret);
    const nextnext = nextSecretNumber(next);

    return [next, nextnext, nextSecretNumber(nextnext)];
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) {
    return Grid.fromArray(readByLine(input).map(line => line.split('')));
}

function nextSecretNumber(x: number) {
    // let a = secret*64 ^ secret;
    //
    //
    // const mix = (secret: number, other: number) => secret ^ other;
    // const prune = (secret: number) => secret % 16777216;
    //
    // const part1 = prune(mix(secret, secret * 64));
    // const part2 = prune(mix(part1, Math.floor(part1 / 32)));
    // const part3 = prune(mix(part2, part2 * 2048));

    const K = 16777216; // Modulo value

    // Step 1: Calculate a
    const a = (65 * x) % K;

    // Step 2: Calculate q (ceil(a / 32))
    const q = Math.ceil(a / 32);

    // Step 3: Calculate b
    const b = (q ^ a) % K;

    // Step 4: Calculate c
    const c = ((b * 2048) ^ b) % K;

    return c;

    return part3;
}