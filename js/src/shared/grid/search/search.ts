import {Cell, Grid} from "../Grid";
import {Direction} from "../Direction";

export function getNeighbors<T>(directions: Direction[], filter: (cell : Cell<T>) => boolean) {
    return (cell : Cell<string>, grid: Grid<string>) => grid
        .nextInDirections(cell.location, directions)
        .filter(cell => cell.value !== '#')
}