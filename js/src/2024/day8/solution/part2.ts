import {Input} from "../../../shared/Input";
import {parsePuzzleInput} from "./parsePuzzleInput";
import {Location} from "../../../shared/grid/Location";
import {Distance} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";

export function part2(input: Input): number {
    const map = parsePuzzleInput(input);
    const frequencies = map.groupByValue();
    const antinodes = new Set<string>();

    for (const locations of frequencies.values()) {
        for (let i = 0; i < locations.length; i++) {
            for (let j = i + 1; j < locations.length; j++) {
                const distance = locations[j].distanceTo(locations[i]);

                let location = locations[i];
                while (true) {
                    if (!map.hasInBounds(location)) {
                        break;
                    }

                    antinodes.add(location.toString());
                    location = location.nextBy(distance);
                }

                location = locations[j];
                while (true) {
                    if (!map.hasInBounds(location)) {
                        break;
                    }

                    antinodes.add(location.toString());
                    location = location.nextBy(distance.revert());
                }
            }
        }
    }

    return antinodes.size;
}