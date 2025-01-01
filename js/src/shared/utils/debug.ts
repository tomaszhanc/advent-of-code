import {Grid} from "../grid/Grid.js";
import chalk from 'chalk';
import {Location} from "../grid/Position.js";

export function printGrid(grid: Grid, path: Location[] = []): void {
    const colors = {
        'S': chalk.green,
        'E': chalk.red,
        '*': chalk.blue,
        '#': chalk.gray,
        '.': chalk.dim,
        'o': chalk.red,
    };

    const printCell = (value: string | number | null) : string => {
        if (typeof value === 'number') {
            return chalk.green(value);
        }

        value = value ?? '.';
        if (Object.prototype.hasOwnProperty.call(colors, value)) {
            return colors[value as keyof typeof colors](value);
        }

        return chalk.white(value);
    };

    // Clear screen and reset cursor
    process.stdout.write('\u001b[H\u001b[J');
    console.log(gridToString(grid, printCell))

    printPath(path);
}

let prevPath: Location[] = [];

export function printPath(path: Location[]) {
    prevPath.forEach(location => {
        process.stdout.write(`\u001b[${location.y + 1};${location.x + 1}H`);
        process.stdout.write(chalk.dim('.'));
    });

    path.forEach(location => {
        process.stdout.write(`\u001b[${location.y + 1};${location.x + 1}H`);
        process.stdout.write(chalk.red('o'));
    });

    prevPath = path;

    // Reset cursor to avoid leaving it in the middle of the grid
    process.stdout.write('\u001b[0;0H');
}

export function gridToExcelString(grid: Grid) : string {
    return gridToString(grid, (value) => value + "\t");
}

export function gridToString(
    grid: Grid,
    cellToString: (value: string) => string = (value) => value
) : string {
    let result = '';

    for (let y = 0; y < grid.height; y++) {
        for (let x = 0; x < grid.width; x++) {
            result += cellToString(grid.valueAt({x, y}) ?? '.');
        }
        result += '\n';
    }

    return result;
}
