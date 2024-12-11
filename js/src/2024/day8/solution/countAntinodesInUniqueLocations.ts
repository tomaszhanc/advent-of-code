import {distanceBetween, Location, locationAsString} from "../../../shared/grid/Location";
import {Distance, invert} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";
import {parsePuzzleInput} from "./_parsePuzzleInput";

export function countAntinodesInUniqueLocations(
    findAntinodes: (location: Location, distance: Distance, map: Grid<string>) => Iterable<Location>,
    input: string,
): number {
    const map = parsePuzzleInput(input);
    const frequencies = map.groupByValue();
    const uniqueAntinodes = new Set<string>();

    for (const locations of frequencies.values()) {
        for (let i = 0; i < locations.length; i++) {
            for (let j = i + 1; j < locations.length; j++) {
                const distance = distanceBetween(locations[i], (locations[j]));

                let antinodes = [
                    ...findAntinodes(locations[i], distance, map),
                    ...findAntinodes(locations[j], invert(distance), map)
                ];

                for (const antinode of antinodes) {
                    uniqueAntinodes.add(locationAsString(antinode));
                }
            }
        }
    }

    return uniqueAntinodes.size;
}