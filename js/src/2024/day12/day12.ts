import {Grid} from "../../shared/grid/Grid";
import {
    isAdjacent, isEqual,
    Location, locationToString,
    nextByDistance,
    nextInDirection,
    nextInDirections,
    sort
} from "../../shared/grid/Location";
import {Direction, rotateClockwise} from "../../shared/grid/Direction";
import {groupByAdjacentValues} from "../../shared/grid/Group";
import {readByLine} from "../../shared/read.input";
import {first} from "../../shared/utils/collection.utils";
import {insideBoundary} from "../../shared/grid/Boundary";
import {findAllSameValueAdjacentCells} from "../../shared/grid/search/dfs";

type Region = {
    readonly plant: string,
    readonly locations: Location[];
}

const directions = [Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT];

export function calculatePriceOfFence(input: string): number {
    const gardenMap = parsePuzzleInput(input);
    const groups = groupByAdjacentValues(gardenMap, ...directions);
    let price = 0;

    for (let group of groups) {
        let region = {plant: group.key, locations: group.locations};
        price += calculateArea(region) * calculatePerimeter(region, gardenMap)
    }

    return price;
}

export function calculatePriceOfFenceWithDiscount(input: string): number {
    const gardenMap = parsePuzzleInput(input);
    const groups = groupByAdjacentValues(gardenMap, ...directions);
    let price = 0;

    for (let group of groups) {
        let region = {plant: group.key, locations: group.locations};
        price += calculateArea(region) * numberOfSides(region)
    }

    return price;
}

const calculateArea = (region: Region) => region.locations.length

function numberOfSides(region : Region) : number {
    const outerSides = numberOfOuterSides(region);
    const smallGrid = Grid.fromMap(
        new Map(region.locations.map(location => [location, region.plant]))
    );

    let innerSides = 0;

    smallGrid.forEach((location, value) => {
        if (!insideBoundary(location, region.locations)) {
            return;
        }

        if (value === region.plant) {
            return;
        }

        const hole = findAllSameValueAdjacentCells(location, smallGrid, directions);
        const holeSides = numberOfOuterSides({plant: '.', locations: hole.map(step => step.location)});

        innerSides += holeSides;
    })

    return outerSides + innerSides;
}

function numberOfOuterSides(region : Region) : number {
    const start = nextByDistance(first(sort(region.locations)), {dX: -1, dY: -1});
    let sides = 1;
    let direction = Direction.RIGHT;

    let current = start;
    let nextDirection = null;
    const outerBoundaryPath = new Set<string>();

    do {
        [current, nextDirection] = findNextCell(current, direction, region, outerBoundaryPath);
        outerBoundaryPath.add(locationToString(current));

        if (direction !== nextDirection) {
            direction = nextDirection;
            sides++;
        }
    } while (current.x !== start.x || current.y !== start.y);

    return sides;
    // return [sides, Array.from(boundaryPath).map(Location.fromString)];
}

function findNextCell(
    location: Location,
    direction: Direction,
    region: Region,
    visited: Set<string>
) : [Location, Direction] {
    for (let i = 0; i < 4; i++) {
        let next = nextInDirection(location, direction);

        if (!isAdjacentTo(next, region)) {
            direction = rotateClockwise(direction);
            continue;
        }

        if (visited.has(locationToString(next))) {
            direction = rotateClockwise(direction);
            continue;
        }

        return [next, direction];
    }

    throw new Error('No next cell found');
}

function isAdjacentTo(location: Location, region: Region) : boolean {
    for (let regionLocation of region.locations) {
        if (isEqual(location, regionLocation)) {
            return false;
        }
    }

    for (let regionLocation of region.locations) {
        if (isAdjacent(location, regionLocation)) {
            return true;
        }
    }

    return false;
}

function calculatePerimeter(region: Region, map: Grid<string>) {
    let perimeter = 0;

    for (let regionLocation of region.locations) {
        for (let neighbour of nextInDirections(regionLocation, [Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT])) {
            if (!map.hasInBounds(neighbour) || map.valueAt(neighbour) !== region.plant) {
                perimeter++;
            }
        }
    }

    return perimeter;
}

function parsePuzzleInput(input: string) {
    return Grid.fromArray(readByLine(input).map(line => line.split('')));
}