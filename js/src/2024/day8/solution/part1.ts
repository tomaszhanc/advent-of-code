import {Input} from "../../../shared/Input";
import {parsePuzzleInput} from "./parsePuzzleInput";

export function uniqueLocationsWithAntinodes(input: Input): number {
    const map = parsePuzzleInput(input);
    const frequencies = map.groupByValue();
    const antinodes = new Set<string>();

    for (const locations of frequencies.values()) {
        for (let i = 0; i < locations.length; i++) {
            for (let j = i + 1; j < locations.length; j++) {
                const distance = locations[j].distanceTo(locations[i]);

                let antinodeLocation = locations[i].nextBy(distance);
                if (map.hasInBounds(antinodeLocation)) {
                    antinodes.add(antinodeLocation.toString());
                }

                antinodeLocation = locations[j].nextBy(distance.revert());
                if (map.hasInBounds(antinodeLocation)) {
                    antinodes.add(antinodeLocation.toString());
                }
            }
        }
    }

    return antinodes.size;
}