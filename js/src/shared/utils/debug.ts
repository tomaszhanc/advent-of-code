import {Grid} from "../grid/Grid";

export function gridToString<T extends number | string>(grid: Grid<T>) : string {
    let result = '';

    for (let y = 0; y < grid.height; y++) {
        for (let x = 0; x < grid.width; x++) {
            result += grid.valueAt({x, y}) ?? '.';
        }
        result += '\n';
    }

    return result;
}

export function gridToExcelString<T extends number | string>(grid: Grid<T>) : string {
    let result = '';

    for (let y = 0; y < grid.height; y++) {
        for (let x = 0; x < grid.width; x++) {
            result += grid.valueAt({x, y}) + "\t";
        }
        result += '\n';
    }

    return result;
}