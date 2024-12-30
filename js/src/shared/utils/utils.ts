export function splitEvenDigitNumber(number: number): [number, number] {
    const numberString = number.toString(10);

    if (numberString.length % 2 !== 0) {
        throw new Error("Number must have an even number of digits");
    }

    const midpoint = numberString.length / 2;

    return [+numberString.substring(0, midpoint), +numberString.substring(midpoint)];
}

/**
 * Mathematical implementation for the modulo operation instead of truncated division used by the % operator.
 * Example: -2 % 7 = -2, but modulo(-2, 7) = 5
 */
export function modulo(dividend: number, divisor: number): number {
    return (dividend % divisor + divisor) % divisor;
}