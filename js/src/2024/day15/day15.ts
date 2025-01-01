import {Direction} from "../../shared/grid/Direction.js";
import {Cell, Grid, isWall} from "../../shared/grid/Grid";
import {Location, nextInDirection} from "../../shared/grid/Position.js";
import {gridToString} from "../../shared/utils/debug.js";

export function part1(input: string): number {
    const [mapData, movements] = parsePuzzleInput(input);
    const map = Grid.fromString(mapData);

    return applyAllMoves(map, movements, moveSingleCellBox)
        .allPositionsOf('O')
        .map(location => 100 * location.y + location.x)
        .reduce((sum, boxGPS) => sum + boxGPS, 0);
}

export function part2(input: string): number {
    const [mapData, movements] = parsePuzzleInput(input);
    const map = Grid.fromString(mapData
        .replaceAll('#', '##')
        .replaceAll('O', '[]')
        .replaceAll('.', '..')
        .replaceAll('@', '@.'));

    return applyAllMoves(map, movements, moveDoubleCellBox)
        .allPositionsOf('[')
        .map(location => 100 * location.y + location.x)
        .reduce((sum, boxGPS) => sum + boxGPS, 0);
}

function parsePuzzleInput(input: string) : [string, Direction[]]{
    let [mapData, movementsData] = input.trim().split('\n\n');

    return [
        mapData,
        movementsData.replaceAll('\n','').split('').map(direction => {
            switch (direction) {
                case '^': return Direction.UP;
                case '>': return Direction.RIGHT;
                case 'v': return Direction.DOWN;
                case '<': return Direction.LEFT;
            }

            throw new Error(`Invalid direction: ${direction}`);
        })
    ]
}

function applyAllMoves(
    map: Grid,
    movements: Direction[],
    moveBox: (box: Cell, direction: Direction, map: Grid) => Grid | null
) : Grid {
    let robotPosition : Location = map.firstPositionOf('@');

    for (let i = 0; i < movements.length; i++) {
        const nextRobotPosition = map.nextInDirection(robotPosition, movements[i]);
        if (nextRobotPosition === null || isWall(nextRobotPosition)) continue;

        if (isBox(nextRobotPosition)) {
            const newMap  = moveBox(nextRobotPosition, movements[i], map);
            if (newMap === null) continue;
            map = newMap;
        }

        map = map.move(robotPosition, nextRobotPosition.location);
        robotPosition = nextRobotPosition.location;
    }

    return map;
}

function moveSingleCellBox(box: Cell, direction: Direction, map: Grid) : Grid | null {
    if (!isBox(box)) throw new Error('Not a box');

    const nextBoxPosition = map.nextInDirection(box.location, direction);
    if (nextBoxPosition === null || isWall(nextBoxPosition)) {
        return null;
    }

    if (isBox(nextBoxPosition)) {
        const newMap = moveSingleCellBox(nextBoxPosition, direction, map);
        if (newMap === null) {
            return null;
        }
        map = newMap;
    }

    return map.move(box.location, nextBoxPosition.location);
}

function moveDoubleCellBox(halfBox: Cell, direction: Direction, map: Grid) : Grid | null {
    if (!isBox(halfBox)) throw new Error('Not a box');

    if (direction === Direction.RIGHT || direction === Direction.LEFT) {
        return moveSingleCellBox(halfBox, direction, map);
    }

    // UP OR DOWN

    const fullBoxPosition = getFullBox(halfBox);
    const nextFullBoxPosition = [
        map.nextInDirection(fullBoxPosition[0], direction),
        map.nextInDirection(fullBoxPosition[1], direction)
    ];

    if (nextFullBoxPosition[0] === null || nextFullBoxPosition[1] === null) {
        return null;
    }

    if (isWall(nextFullBoxPosition[0]) || isWall(nextFullBoxPosition[1])) {
        return null;
    }

    if (isBox(nextFullBoxPosition[0])) {
        const newMap = moveDoubleCellBox(nextFullBoxPosition[0], direction, map)
        if (newMap === null) {
            return null;
        }
        map = newMap;
    }

    if (nextFullBoxPosition[1].value === '[') {
        const newMap = moveDoubleCellBox(nextFullBoxPosition[1], direction, map)
        if (newMap === null) {
            return null;
        }
        map = newMap;
    }

    try {
        map = map.move(fullBoxPosition[0], nextFullBoxPosition[0].location);
        map = map.move(fullBoxPosition[1], nextFullBoxPosition[1].location);
    } catch (e) {
        console.log(gridToString(map));
        throw e;
    }

    return map;
}

function getFullBox(box: Cell) : [Location, Location] {
    if (box.value === '[') {
        return [box.location, nextInDirection(box.location, Direction.RIGHT)];
    }

    return [nextInDirection(box.location, Direction.LEFT), box.location]
}

const isBox = (cell: Cell) => cell.value === 'O' || cell.value === '[' || cell.value === ']';