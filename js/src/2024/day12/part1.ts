import {parsePuzzleInput} from "./_parsePuzzleInput";
import {Grid} from "../../shared/grid/Grid";
import {Location, nextInDirections} from "../../shared/grid/Location";
import {Direction} from "../../shared/grid/Direction";

type Region = {
    readonly plant: string,
    readonly locations: Location[];
}

export function calculatePriceOfFence(input: string): number {
    const gardenMap = parsePuzzleInput(input);
    const regions = gardenMap.groupByValue();
    let price = 0;

    for (let [plant, locations] of regions) {
        let area = calculateArea({plant, locations});
        let perimeter = calculatePerimeter({plant, locations}, gardenMap);
        let a = area * perimeter;
        price += a;
    }

    return price;
}

const calculatePrice = (region: Region, map: Grid<string>) => calculateArea(region) * calculatePerimeter(region, map)

const calculateArea = (region: Region) => region.locations.length

const calculatePerimeter = (region: Region, map: Grid<string>) => {
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