import path from "path";
import {n} from "vitest/dist/chunks/reporters.D7Jzd9GS.js";
import {Direction} from "../../shared/grid/Direction.js";
import {Grid} from "../../shared/grid/Grid.js";
import {alreadyVisited, equals, Location} from "../../shared/grid/Position.js";
import {Queue} from "../../shared/struct/Queue.js";
import {lastItem, push} from "../../shared/utils/collection.utils.js";
import {cartesianProduct} from "../../shared/utils/generator.utils.js";
import {asKey} from "../../shared/utils/utils.js";

const numericKeypad = Grid.fromArray([
    ['7','8','9'],
    ['4','5','6'],
    ['1','2','3'],
    ['#','0','A']
]);
const directionKeypad = Grid.fromArray([
    ['#','^','A'],
    ['<','v','>'],
])

export function part1(input: string): number {
    const codes = input.trim().split('\n');

    return calculateComplexity(codes, 2);
}

export function part2(input: string): number {
    const codes = input.trim().split('\n');

    return calculateComplexity(codes, 25);
}

function calculateComplexity(codes: string[], numberOfRobots : number) : number {
    const knownMoves = precalculateMoves(directionKeypad);
    const knownMovesLengths = precalculateMovesLengths(numberOfRobots, directionKeypad, knownMoves);

    let sum = 0;
    for (const code of codes) {
        const number = Number.parseInt(code);
        const pathLength = findTheShortestPath(code, knownMovesLengths);

        sum += (number * pathLength);
    }

    return sum;
}

function precalculateMoves(keypad: Grid) : Map<string, string[]> {
    const moves = new Map<string, string[]>();

    for (const from of keypad.cells.values()) {
        for (const to of keypad.cells.values()) {
            if (from === '#' || to === '#') continue;
            moves.set(asKey(from, to), findAllShortestPathsBetweenKeys(from, to, keypad));
        }
    }

    return moves;
}

function precalculateMovesLengths(numberOfRobots: number, keypad: Grid, knownMoves: Map<string, string[]>) : Map<string, number> {
    const moveLengths = new Map<string, number>();

    for (const from of keypad.cells.values()) {
        for (const to of keypad.cells.values()) {
            if (from === '#' || to === '#') continue;
            let moves = knownMoves.get(asKey(from, to));
            if (moves === undefined) throw Error(`No move found from ${from} to ${to}`);

            moveLengths.set(
                asKey(from, to),
                shortestMovesLength(moves, numberOfRobots - 1, knownMoves)
            );
        }
    }

    return moveLengths;
}

const allLengths = new Map<string, number>();
function shortestMovesLength(listOfMoves: string[], numberOfRobots: number, allShortestMoves: Map<string, string[]>) : number {
    const lengths = [];

    for (const moves of listOfMoves) {
        let from = 'A';
        let length = 0;

        for (const to of moves) {
            let shortestLength = allLengths.get(asKey(numberOfRobots.toString(), from, to));
            if (shortestLength === undefined) {
                let shortestMoves = allShortestMoves.get(asKey(from, to));
                if (shortestMoves === undefined) throw new Error(`No moves found from ${from} to ${to}`);
                shortestLength = shortestMoves[0].length;

                if (numberOfRobots > 1) {
                    shortestLength = shortestMovesLength(shortestMoves, numberOfRobots - 1, allShortestMoves);
                }

                allLengths.set(asKey(numberOfRobots.toString(), from, to), shortestLength);
            }

            length += shortestLength;
            from = to;
        }

        lengths.push(length);
    }

    return Math.min(...lengths);
}

function findTheShortestPath(code: string, movesLengths: Map<string, number>) : number {
    let totalLength : number = 0;
    let codeFrom = 'A';

    for (const codeTo of code) {
        const firstRobotPaths = findAllShortestPathsBetweenKeys(codeFrom, codeTo, numericKeypad);

        const lengths = [];
        for (const path of firstRobotPaths) {
            let from = 'A';
            let length = 0;

            for (const to of path) {
                let minLength = movesLengths.get(asKey(from, to));
                if (minLength === undefined) throw new Error(`No possible moves found from ${from} to ${to}`);

                length += minLength;
                from = to;
            }

            lengths.push(length);
        }

        codeFrom = codeTo;
        totalLength += Math.min(...lengths);

        // <vA<AA>>^A vAA<^A>A <v<A>>^AvA^A <vA>^A<v<A>^A>AAvA^A <v<A>A>^AAAvA<^A>A
        // v<<A >>^A           <A>A         vA<^AA>A             <vAAA>^A
        // <A                  ^A           >^^A                 vvvA
        // 0                   2            9                    A

        // 18 + 12 + 20 + 18 = 68
        // console.log('done', to, 'from', code)
    }

    return totalLength;
}

function findAllShortestPathsBetweenKeys(startKey: string, endKey: string, keypad: Grid) : string[] {
    const paths : string[] = [];
    const start = keypad.firstLocationOf(startKey);
    const end = keypad.firstLocationOf(endKey);

    const queue = new Queue<[Location[], string[]]>();
    queue.enqueue([[start], []]);

    while (!queue.isEmpty()) {
        const [currentPath, currentMoves] = queue.dequeue();
        const current = lastItem(currentPath);

        if (equals(current, end)) {
            paths.push([...currentMoves, 'A'].join(''));
            continue;
        }

        for (const direction of Direction.allOrthogonal()) {
            const next = keypad.nextInDirection(current, direction);
            if (next === null || next.value === '#' || alreadyVisited(next.location, currentPath)) {
                continue;
            }

            if (paths.length > 0 && currentPath.length > paths[0].length) {
                continue;
            }

            queue.enqueue([
                [...currentPath, next.location],
                [...currentMoves, directionToString(direction)]
            ]);
        }
    }

    return paths;
}

function directionToString(direction: Direction) : string {
    switch (direction) {
        case Direction.UP: return '^';
        case Direction.DOWN: return 'v';
        case Direction.LEFT: return '<';
        case Direction.RIGHT: return '>';
    }

    throw new Error(`Invalid direction: ${direction}`);
}