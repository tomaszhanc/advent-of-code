import {Grid} from "../grid/Grid";
import {Location} from "../grid/Location";

export function gridToExcel<T extends number | string>(grid: Grid<T>) : string {
    let result = '';

    for (let y = 0; y < grid.height; y++) {
        for (let x = 0; x < grid.width; x++) {
            result += grid.valueOf({ x, y }) + "\t";
        }
        result += '\n';
    }

    return result;
}