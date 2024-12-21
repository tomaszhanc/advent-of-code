import {Location, locationsToString, locationToString} from "./Location.js";

export class Unique<T extends Location | Location[]> {
    private readonly visited = new Set<string>;

    public add(item: T) : void {
        this.visited.add(
            Array.isArray(item) ? locationsToString(...item) : locationToString(item)
        );
    }

    public has(item: T) : boolean {
        return this.visited.has(
            Array.isArray(item) ? locationsToString(...item) : locationToString(item)
        );
    }

    public size() : number {
        return this.visited.size
    }
}
