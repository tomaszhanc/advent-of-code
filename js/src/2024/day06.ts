import {Input, readPuzzleInput} from "../shared/input";
import {Direction, Grid, Location} from "../shared/grid";
import {printAnswer} from "../shared/print-answer";

const solvePart1 = (input: Input): number => {
    const [guard, tiles] = parseInput(input);
    return tilesVisitedByGuard(guard, tiles);
}

const solvePart2 = (input: Input): number => {
    const [guard, tiles] = parseInput(input);
    return _solution_part_2_(guard, tiles);
}


const tilesVisitedByGuard = (guardPosition: GuardPosition, map : Grid<Tile>): number => {
    const visited = new Set<string>();
    let currentGuardPosition = nextGuardPosition(guardPosition, map);

    while (currentGuardPosition !== null) {
        // guardPath = guardPath.addStep(guardPosition.position);
        visited.add(currentGuardPosition.position.toString());
        currentGuardPosition = nextGuardPosition(currentGuardPosition, map);
    }

    return visited.size
}

const nextGuardPosition = (guardPosition: GuardPosition, map: Grid<Tile>): GuardPosition | null => {
    for (let i = 0; i < 3; i++) {
        const nextPosition = guardPosition.nextMove();
        const nextTile = map.valueOf(nextPosition);

        if (nextTile === null) {
            return null;
        }

        if (nextTile.isObstacle()) {
            guardPosition = guardPosition.turnRight();
            continue;
        }

        return new GuardPosition(nextPosition, guardPosition.direction);
    }

    throw new Error('Guard is stuck');
}

const _solution_part_2_ = (guardPosition: GuardPosition, map : Grid<Tile>): number => {

    return 0;
}

const parseInput = (input: Input): [GuardPosition, Grid<Tile>] => {
    let map = new Grid(input.lines().map(line => line.split('').map(char => new Tile(char))));
    const guardLocation = map.locationOf(new Tile('^'));

    if (guardLocation === null) {
        throw new Error('Guard not found');
    }

    let guardPosition = new GuardPosition(guardLocation, Direction.UP);

    return [guardPosition, map];
}

class Tile {
    constructor(
        public readonly value: string
    ) {
    }

    isObstacle() {
        return this.value === '#';
    }
}

class GuardPosition {
    constructor(
        public readonly position: Location,
        public readonly direction: Direction
    ) {
    }

    public nextMove(): Location {
        return this.position.next(this.direction);
    }

    turnRight() : GuardPosition {
        return new GuardPosition(
            this.position,
            Direction.rotateClockwise(this.direction)
        );
    }
}

printAnswer('2024/day6.txt', solvePart1);