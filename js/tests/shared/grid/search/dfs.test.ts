import {describe, it, expect} from 'vitest'
import {Cell, Grid} from "../../../../src/shared/grid/Grid";
import {
    findAllPaths,
    findAllEqualAdjacentCells,
    findLongestPath, findShortestPath
} from "../../../../src/shared/grid/search/dfs";
import {Direction} from "../../../../src/shared/grid/Direction";

const grid = Grid.fromString<string>(`
S.....
.####.
...##X
##.##.
##..#.
###...
`);

const neighbors = (cell : Cell<string>) => {
    return grid
        .nextInDirections(cell.location, Direction.allOrthogonal())
        .filter(cell => cell.value !== '#')
}
const finishAtX = (cell : Cell<string>) => cell.value === 'X';

describe('deep first search', () => {
    it('finds all paths', () => {
        const paths = Array.from(findAllPaths({x: 0, y: 0}, grid, neighbors, finishAtX));

        expect(paths.length).toBe(2);
        expect(paths.map(path => path.length)).toStrictEqual([14, 8]);
    });

    it('finds the longest path', () => {
        const longestPath = findLongestPath({x: 0, y: 0}, grid, neighbors, finishAtX);

        expect(longestPath.length).toBe(14);
    });

    it('finds the shortest path', () => {
        const longestPath = findShortestPath({x: 0, y: 0}, grid, neighbors, finishAtX);

        expect(longestPath.length).toBe(8);
    });

    it('finds all adjacent cells of the same value', () => {
        let path = findAllEqualAdjacentCells({x: 1, y: 1}, grid, Direction.allOrthogonal());
        expect(path.length).toBe(9);

        path = findAllEqualAdjacentCells({x: 0, y: 3}, grid, Direction.allOrthogonal());
        expect(path.length).toBe(7);
    });
});