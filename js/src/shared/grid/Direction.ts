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
    export function rotateClockwise(direction : Direction) : Direction {
        switch (direction) {
            case Direction.UP: return Direction.RIGHT;
            case Direction.RIGHT: return Direction.DOWN;
            case Direction.DOWN: return Direction.LEFT;
            case Direction.LEFT: return Direction.UP;
        }

        throw new Error(`Invalid direction: ${direction}`);
    }
}