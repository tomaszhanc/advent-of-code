export function occurrencesOf(element: number, array: number[]): number {
    return array.filter((e: number) => e === element).length;
}

export function lastElement<T>(array: T[]) : T {
    return array[array.length - 1];
}
