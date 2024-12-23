export enum Direction {
    UP = 1,
    RIGHT = 2,
    DOWN = 4,
    LEFT = 8,
    UP_LEFT = UP | LEFT,
    UP_RIGHT = UP | RIGHT,
    DOWN_LEFT = DOWN | LEFT,
    DOWN_RIGHT = DOWN | RIGHT,
}

export namespace Direction {
    export function allOrthogonal() : Direction[] {
        return [Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT];
    }
}

export function rotateClockwise(direction : Direction) : Direction {
    const directionMap = {
        [Direction.UP_LEFT]:    Direction.UP_RIGHT,
        [Direction.UP]:         Direction.RIGHT,
        [Direction.UP_RIGHT]:   Direction.DOWN_RIGHT,
        [Direction.RIGHT]:      Direction.DOWN,
        [Direction.DOWN_RIGHT]: Direction.DOWN_LEFT,
        [Direction.DOWN]:       Direction.LEFT,
        [Direction.DOWN_LEFT]:  Direction.UP_LEFT,
        [Direction.LEFT]:       Direction.UP,
    };

    return directionMap[direction];
}

export function rotateCounterclockwise(direction : Direction) : Direction {
    const directionMap = {
        [Direction.UP_LEFT]:    Direction.DOWN_LEFT,
        [Direction.LEFT]:       Direction.DOWN,
        [Direction.DOWN_LEFT]:  Direction.DOWN_RIGHT,
        [Direction.DOWN]:       Direction.RIGHT,
        [Direction.DOWN_RIGHT]: Direction.UP_RIGHT,
        [Direction.RIGHT]:      Direction.UP,
        [Direction.UP_RIGHT]:   Direction.UP_LEFT,
        [Direction.UP]:         Direction.LEFT,
    };

    return directionMap[direction];
}