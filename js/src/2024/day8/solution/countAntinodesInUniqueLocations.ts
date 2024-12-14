import {distanceBetween, Location, locationAsString} from "../../../shared/grid/Location";
import {Distance, invert} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";
import {parsePuzzleInput} from "./_parsePuzzleInput";
import {groupByValue} from "../../../shared/grid/Group";

export function countAntinodesInUniqueLocations(
    findAntinodes: (location: Location, distance: Distance, map: Grid<string>) => Iterable<Location>,
    input: string,
): number {
    const map = parsePuzzleInput(input);
    const frequencies = groupByValue(map);
    const uniqueAntinodes = new Set<string>();

    for (const frequency of frequencies) {
        for (let i = 0; i < frequency.locations.length; i++) {
            for (let j = i + 1; j < frequency.locations.length; j++) {
                const distance = distanceBetween(frequency.locations[i], (frequency.locations[j]));

                let antinodes = [
                    ...findAntinodes(frequency.locations[i], distance, map),
                    ...findAntinodes(frequency.locations[j], invert(distance), map)
                ];

                for (const antinode of antinodes) {
                    uniqueAntinodes.add(locationAsString(antinode));
                }
            }
        }
    }

    return uniqueAntinodes.size;
}