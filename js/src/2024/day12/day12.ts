import path from "path";
import {Grid} from "../../shared/grid/Grid";
import {
    isAdjacent, equals,
    Location, locationToString,
    nextByDistance,
    nextInDirection,
    sort, nextInDirections, distanceBetween, alreadyVisited
} from "../../shared/grid/Position.js";
import {Direction, directionToString, rotateClockwise} from "../../shared/grid/Direction";
import {splitByConnectedComponents} from "../../shared/grid/Group";
import {Queue} from "../../shared/struct/Queue.js";
import {first, last} from "../../shared/utils/collection.utils";
import {insideBoundary} from "../../shared/grid/Boundary";
import {findAllSameValueAdjacentCells} from "../../shared/grid/search/dfs";
import {gridToString} from "../../shared/utils/debug.js";

export function part1(input: string): number {
    const garden = Grid.fromString(input);
    const components = splitByConnectedComponents(garden);
    let price = 0;

    for (let component of components) {
        let region = {plant: component.key, locations: component.locations};
        price += calculateArea(region) * calculatePerimeter(region, garden)
    }

    return price;
}

export function part2(input: string): number {
    const gardenMap = Grid.fromString(input);
    const groups = splitByConnectedComponents(gardenMap);
    let price = 0;

    for (let group of groups) {
        let region = {plant: group.key, locations: group.locations};
        price += calculateArea(region) * numberOfSides(region, gardenMap)
    }

    return price;
}

type Region = {
    readonly plant: string,
    readonly locations: Location[];
}

function calculateArea(region: Region) {
    return region.locations.length
}

function calculatePerimeter(region: Region, map: Grid) {
    let countOfNeighbours = 0;

    for (let location of region.locations) {
        for (let neighbour of map.nextInDirections(location, Direction.allOrthogonal())) {
            if (neighbour.value === region.plant) {
                countOfNeighbours++;
            }
        }
    }

    return calculateArea(region) * 4 - countOfNeighbours;
}

function numberOfSides(region : Region, garden: Grid) : number {
    // by policzyć "dziury" musze pogrubowac raz jeszcze? w sensie musz policzc side tych dziur jakoś i dodać do wyniku?
    //
    // if (region.plant !== 'C') {
    //     return 0;
    // }

    const regionBorder = findRegionBorder(region).map(location => nextByDistance(location, {dX: 1, dY: 1}));
    const grid = Grid.fromLocations(regionBorder);

    const start = first(regionBorder);
    const queue = new Queue<[Location, Direction][]>();
    queue.enqueue([[start, Direction.RIGHT]]);

    const bla = function () {
        while (!queue.isEmpty()) {
            const currentPath = queue.dequeue();
            const [currentLocation, currentDirection] = last(currentPath);

            if (currentPath.length > regionBorder.length) {
                if (equals(currentLocation, start)) {
                    return currentPath.slice(1);
                }
            }

            // 3 rotations because we don't want to go back
            let direction = currentDirection;
            for (let i = 0; i < 4; i++) {
                let next = grid.nextInDirection(currentLocation, direction);

                if (next !== null && next.value != null && !alreadyVisited(next.location, direction, currentPath)) {
                    queue.enqueue([...currentPath, [next.location, direction]]);
                }

                direction = rotateClockwise(direction);
            }
        }

        throw new Error('It should not happen');
    }

    let sides = 0;
    let currentDirection = null;
    for (const [_, direction] of bla()) {
        if (currentDirection !== direction) {
            currentDirection = direction;
            sides++;
        }
    }

    return sides;
}

function findRegionBorder(region: Region) : Location[] {
    // set of locations as string to have a simple check for has() method
    const regionLocations = new Set(region.locations.map(locationToString));

    // to filter out duplicates
    const regionBorder = new Set(region.locations.flatMap(
        location => nextInDirections(location, Direction.all())
            .filter(location => !regionLocations.has(locationToString(location)))
    ).map(locationToString));

    return Array.from(regionBorder).map(Location.fromString).sort((a, b) => a.y - b.y || a.x - b.x);
}

function alreadyVisited(location: Location, direction: Direction, path: [Location, Direction][]) : boolean {
    return path.some(other => equals(location, other[0]) && direction === other[1])
}

const toString = (location: Location, direction: Direction) => `${locationToString(location)}-${directionToString(direction)}`;
