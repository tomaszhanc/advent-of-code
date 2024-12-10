import {Location} from "../grid/Location";

export function occurrencesOf(element: number, array: number[]): number {
    return array.filter((e: number) => e === element).length;
}

export function first<T>(array: T[]) : T {
    return array[0];
}

export function last<T>(array: T[]) : T {
    return array[array.length - 1];
}

export function groupBy(array: string[]) : Map<string, { index: number, value: string }[]> {
    const groups = new Map<string, { index: number, value: string }[]>();

    for (const [i, value] of array.entries()) {
        if (!groups.has(value)) {
            groups.set(value, []);
        }

        groups.get(value)!.push({index: i, value: value});
    }

    return groups;
}