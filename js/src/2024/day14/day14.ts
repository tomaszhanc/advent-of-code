import {Position} from "../../shared/grid/Position.js";
import {readByLine} from "../../shared/read.input.js";
import {Distance} from "../../shared/grid/Distance.js";
import {modulo} from "../../shared/utils/utils.js";

export function part1(width: number, height: number, input: string): number {
    const robots = parsePuzzleInput(input);

    return totalSafetyFactorAfterSeconds(100, robots, width, height);
}

export function part2(width: number, height:number, input: string): number {
    const robots = parsePuzzleInput(input);

    let bestTimeToGoToBathroom = 0;
    let minSafetyFactor = Number.MAX_SAFE_INTEGER;
    for (let i = 0; i < width * height; i++) {
        const current = totalSafetyFactorAfterSeconds(i, robots, width, height);

        if (current < minSafetyFactor) {
            minSafetyFactor = current;
            bestTimeToGoToBathroom = i;
        }
    }

    return bestTimeToGoToBathroom;
}

type Robot = {position: Position, velocity: Distance};

function parsePuzzleInput(input: string) : Robot[] {
    return readByLine(input).map(line => {
        const match = line.match(/p=(-?\d+),(-?\d+) v=(-?\d+),(-?\d+)/);
        if (!match) {
            throw new Error('Invalid input');
        }

        const position = new Position(Number.parseInt(match[1]), Number.parseInt(match[2]));
        const velocity = { dX: Number.parseInt(match[3]), dY: Number.parseInt(match[4]) };

        return {position, velocity};
    });
}

function positionAfterSeconds(time: number, position: Position, velocity: Distance, width: number, height: number): Position {
    return new Position(
        modulo(position.x + velocity.dX * time, width),
        modulo(position.y + velocity.dY * time, height)
    );
}

function totalSafetyFactorAfterSeconds(time: number, robots: Robot[], width: number, height: number) : number {
    const finalPositions = new Map<string, number>;

    for (const robot of robots) {
        const finalPosition = positionAfterSeconds(time, robot.position, robot.velocity, width, height);
        finalPositions.set(
            finalPosition.toString(),
            (finalPositions.get(finalPosition.toString()) ?? 0) + 1
        );
    }

    const middleX = (width-1)/2;
    const middleY = (height-1)/2;
    const quadrants = [
        [{x: 0,          y: 0},           {x: middleX -1, y: middleY -1}],
        [{x: 0,          y: middleY +1},  {x: middleX -1, y: height -1}],
        [{x: middleX +1, y: 0},           {x: width -1,   y: middleY -1}],
        [{x: middleX +1, y: middleY +1},  {x: width -1,   y: height -1}],
    ];

    let totalSafetyFactor = 1;
    for (const [start, end] of quadrants) {
        totalSafetyFactor *= finalPositions
            .entries()
            .filter(([position, _]) => Position.fromString(position).inBounds(start, end))
            .reduce((safetyFactor, [_, robotsCount]) => safetyFactor + robotsCount, 0);
    }

    return totalSafetyFactor;
}
