import {Grid} from "../../shared/grid/Grid";
import {Location, nextInDirections} from "../../shared/grid/Location";
import {Direction} from "../../shared/grid/Direction";
import {groupByAdjacentValues} from "../../shared/grid/Group";
import {readByLine} from "../../shared/read.input";

type Region = {
    readonly plant: string,
    readonly locations: Location[];
}

export function calculatePriceOfFence(input: string): number {
    const gardenMap = parsePuzzleInput(input);
    const groups = groupByAdjacentValues(gardenMap, Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT);
    let price = 0;

    for (let group of groups) {
        let region = {plant: group.key, locations: group.locations};
        price += calculatePrice(region, gardenMap);
    }

    return price;
}

const calculatePrice = (region: Region, map: Grid<string>) => calculateArea(region) * calculatePerimeter(region, map)

const calculateArea = (region: Region) => region.locations.length

function calculatePerimeter(region: Region, map: Grid<string>) {
    let perimeter = 0;

    for (let regionLocation of region.locations) {
        for (let neighbour of nextInDirections(regionLocation, Direction.UP, Direction.RIGHT, Direction.DOWN, Direction.LEFT)) {
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