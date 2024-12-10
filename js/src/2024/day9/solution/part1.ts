import {diskMapToMemory} from "./disk";
import {calculateCheckSum, compactMemory} from "./memory";

export function calculateCheckSumOfCompactedHardDrive(input: string): number {
    return calculateCheckSum(compactMemory(diskMapToMemory(input)));
}