import {diskMapToMemory} from "./disk";
import {compactMemoryByBlock} from "./memory-by-block";
import {compactMemoryByFile} from "./memory-by-file";

export function calculateCheckSumOfCompactedByBlockMemory(input: string): number {
    return calculateCheckSum(compactMemoryByBlock(diskMapToMemory(input)));
}

export function calculateCheckSumOfCompactedByBlockFile(input: string): number {
    return calculateCheckSum(compactMemoryByFile(diskMapToMemory(input)));
}


function calculateCheckSum(memory: string[]) : number {
    return memory.reduce(
        (sum, block, index) => block === '.' ? sum : sum + (+block * index),
        0
    );
}