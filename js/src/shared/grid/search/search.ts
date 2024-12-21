import {Cell, Grid} from "../Grid.js";
import {Direction} from "../Direction.js";

export function getNeighbors<T>(directions: Direction[], filter: (cell : Cell<T>) => boolean) {
    return (cell : Cell<string>, grid: Grid<string>) => grid
        .nextInDirections(cell.location, directions)
        .filter(cell => cell.value !== '#')
}