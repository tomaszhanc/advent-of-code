import {Location} from "./Position.js";

export function insideBoundary(location: Location, boundary: Location[]) {
    const yLocations : Location[] = [];

    for (let boundaryLocation of boundary) {
        if (location.y === boundaryLocation.y) {
            yLocations.push(boundaryLocation);
        }
    }

    if (yLocations.length === 0) {
        return false;
    }

    const xMin = Math.min(...yLocations.map(location => location.x));
    const xMaX = Math.max(...yLocations.map(location => location.x));

    return location.x >= xMin && location.x <= xMaX;
}