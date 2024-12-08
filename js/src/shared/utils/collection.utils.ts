export function occurrencesOf(element: number, array: number[]): number {
    return array.filter((e: number) => e === element).length;
}

export function first<T>(array: T[]) : T {
    return array[0];
}

export function last<T>(array: T[]) : T {
    return array[array.length - 1];
}
