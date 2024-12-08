import {Location} from "../../../shared/grid/Location";
import {Distance} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";
import {parsePuzzleInput} from "./parsePuzzleInput";

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
                const distance = locations[j].distanceTo(locations[i]);

                let antinodes = [
                    ...findAntinodes(locations[i], distance, map),
                    ...findAntinodes(locations[j], distance.revert(), map)
                ];

                for (const antinode of antinodes) {
                    uniqueAntinodes.add(antinode.toString());
                }
            }
        }
    }

    return uniqueAntinodes.size;
}