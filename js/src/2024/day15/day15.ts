import {Direction} from "../../shared/grid/Direction.js";
import {Cell, Grid, isWall} from "../../shared/grid/Grid";
import {Location} from "../../shared/grid/Position.js";

export function part1(input: string): number {
    const [map, movements] = parsePuzzleInput(input);

    return applyAllMoves(map, movements)
        .allPositionsOf('O')
        .map(location => 100 * location.y + location.x)
        .reduce((sum, boxGPS) => sum + boxGPS, 0);
}

export function part2(input: string): number {
    const _ = parsePuzzleInput(input);

    return 0;
}

function parsePuzzleInput(input: string) : [Grid, Direction[]]{
    let [mapData, movementsData] = input.trim().split('\n\n');

    return [
        Grid.fromString(mapData),
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

function applyAllMoves(map: Grid, movements: Direction[]) : Grid {
    let robotPosition : Location = map.firstPositionOf('@');

    for (let i = 0; i < movements.length; i++) {
        const nextRobotPosition = map.nextInDirection(robotPosition, movements[i]);
        if (nextRobotPosition === null || isWall(nextRobotPosition)) {
            continue;
        }

        if (isBox(nextRobotPosition)) {
            map = moveBox(nextRobotPosition, movements[i], map);
            if (isBox(map.cellAt(nextRobotPosition.location))) {
                continue;
            }
        }

        map = map.move(robotPosition, nextRobotPosition.location);
        robotPosition = nextRobotPosition.location;
    }

    return map;
}

function moveBox(box: Cell, direction: Direction, map: Grid) : Grid {
    if (!isBox(box)) throw new Error('Not a box');

    const nextBoxPosition = map.nextInDirection(box.location, direction);

    if (nextBoxPosition === null || isWall(nextBoxPosition)) {
        return map;
    }

    if (isBox(nextBoxPosition)) {
        map = moveBox(nextBoxPosition, direction, map);
        if (isBox(map.cellAt(nextBoxPosition.location))) {
            return map;
        }
    }

    return map.move(box.location, nextBoxPosition.location);
}

const isBox = (cell: Cell) => cell.value === 'O';