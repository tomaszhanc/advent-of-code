import {Location, nextByDistance} from "../../../shared/grid/Position.js";
import {Distance} from "../../../shared/grid/Distance";
import {Grid} from "../../../shared/grid/Grid";

export function* findResonantHarmonicAntinodes(location: Location, distance: Distance, map: Grid): Generator<Location> {
    while (map.hasInBounds(location)) {
        yield location;
        location = nextByDistance(location, distance);
    }
}