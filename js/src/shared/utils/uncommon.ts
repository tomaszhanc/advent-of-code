export function splitEvenDigitNumber(number: number): [number, number] {
    const numberString = number.toString(10);

    if (numberString.length % 2 !== 0) {
        throw new Error("Number must have an even number of digits");
    }

    const midpoint = numberString.length / 2;

    return [+numberString.substring(0, midpoint), +numberString.substring(midpoint)];
}