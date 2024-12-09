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