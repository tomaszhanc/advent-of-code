import { occurrencesOf } from "../shared/collection";
import { Input } from "../shared/input";

export const solvePart1 = (input: Input): number => {
    const [list1, list2] = parseInput(input);
    return totalDistanceBetweenTwoLists(list1, list2);
}

export const solvePart2 = (input: Input): number => {
    const [list1, list2] = parseInput(input);
    return similarityScore(list1, list2);
}

const totalDistanceBetweenTwoLists = (list1: number[], list2: number[]): number => {
    list1.sort((a, b) => a - b);
    list2.sort((a, b) => a - b);

    return list1.reduce((sum, num, i) => {
        return sum + Math.abs(num - list2[i]);
    }, 0);
}

const similarityScore = (list1: number[], list2: number[]): number => {
    list1.sort((a, b) => a - b);

    return list1.reduce((sum, number) => {
        return sum + number * occurrencesOf(number, list2);
    }, 0);
}

const parseInput = (input: Input): [number[], number[]] => {
    const list1: number[] = [];
    const list2: number[] = [];

    for (const line of input.lines()) {
        const match = line.match(/^(\d+)\s+(\d+)$/);

        if (match) {
            list1.push(parseInt(match[1], 10));
            list2.push(parseInt(match[2], 10));
        }
    }

    return [list1, list2];
}
