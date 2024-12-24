import {readByLine} from "../../shared/read.input";

export function part1(input: string): number {
    const secretNumbers = parsePuzzleInput(input);
    let sum = 0;

    for (let secret of secretNumbers) {
        for (let i = 0; i < 2000; i++) {
            secret = nextSecretNumber(secret);
        }

        sum += secret;
    }

    return sum;
}

export function part2(input: string): number {
    const secretNumbers = parsePuzzleInput(input);
    const priceChangeSequences = new Map<string, number>();
    let maxPrice = 0;

    for (let secret of secretNumbers) {
        const occurredSequences = new Set<string>;
        const lastPriceChanges : number[] = [];
        let previousPrice : number = getPrice(secret);

        for (let i = 0; i < 2000; i++) {
            secret = nextSecretNumber(secret);

            let currentPrice = getPrice(secret);
            lastPriceChanges.push(currentPrice - previousPrice);
            previousPrice = currentPrice;

            if (i < 3) continue;

            const sequenceId = lastPriceChanges.join(',');
            lastPriceChanges.shift();

            if (occurredSequences.has(sequenceId)) continue;

            occurredSequences.add(sequenceId);
            priceChangeSequences.set(sequenceId, (priceChangeSequences.get(sequenceId) ?? 0) + currentPrice);
            maxPrice = Math.max(maxPrice, priceChangeSequences.get(sequenceId)!);
        }
    }

    return maxPrice;
}

function parsePuzzleInput(input: string) : number[] {
    return readByLine(input).map(Number);
}

function nextSecretNumber(secret: number) : number {
    const mix = (secret: number, other: number) => secret ^ other;
    const prune = (secret: number) => secret & 0xFFFFFF // = secret % 2^24 = secret % 16777216

    const part1 = prune(mix(secret, (secret << 6)));
    const part2 = prune(mix(part1, part1 >> 5));
    return prune(mix(part2, part2 << 11));
}

const getPrice = (secret: number) => secret < 10 ? secret : secret % 10;