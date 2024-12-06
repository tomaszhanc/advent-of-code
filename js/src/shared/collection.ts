// vs Array.prototype.occurrencesOf ???
export const occurrencesOf = (element: number, array: number[]): number => {
    return array.filter((e: number) => e === element).length;
}
