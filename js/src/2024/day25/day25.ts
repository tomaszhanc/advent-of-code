import {Grid} from "../../shared/grid/Grid";

export function part1(input: string): number {
    const [locks, keys] = parsePuzzleInput(input);
    let fits = 0;

    for (const lock of locks) {
        for (const key of keys) {
            if (isAFit(key, lock)) {
                fits++;
            }
        }
    }

    return fits;
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) : [number[][], number[][]] {
    const locks = [];
    const keys = [];

    for (let schematic of input.trim().split('\n\n')) {
        if (isLock(schematic)) {
            locks.push(pinsToHeights(Grid.fromString(withoutFirstAndLastLine(schematic))));
        } else {
            keys.push(pinsToHeights(Grid.fromString(withoutFirstAndLastLine(schematic))));
        }
    }

    return [locks, keys];
}

function isAFit(key: number[], lock: number[]) : boolean {
    for (let i = 0; i < key.length; i++) {
        if (key[i] + lock[i] > 5) {
            return false;
        }
    }

    return true;
}

const isLock = (schematic: string) : boolean => schematic.startsWith('#');
const withoutFirstAndLastLine = (schematic: string) : string => schematic.split('\n').slice(1,-1).join('\n');
const pinsToHeights = (schematic: Grid) : number[] => schematic.mapColumns(column => column.filter(cell => cell.value === '#').length);