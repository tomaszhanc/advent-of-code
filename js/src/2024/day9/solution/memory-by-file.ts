export function compactMemoryByFile(memory: string[]): string[] {
    let compactedMemory = Array.from(memory);
    let [files, freeSpace] = groupByFiles(memory);

    for (let [fileId, fileBlocks] of files) {
        for (let i = 0; i < freeSpace.length; i++) {
            // Stop compacting
            if (freeSpace[i][0] > fileBlocks[0]) {
                break;
            }

            if (fileBlocks.length <= freeSpace[i].length) {
                for (let j = 0; j < fileBlocks.length; j++) {
                    // Move all file blocks to an earlier position in memory
                    compactedMemory[freeSpace[i][j]] = fileId.toString();
                    compactedMemory[fileBlocks[j]] = '.';
                }

                // Remove used free space
                freeSpace[i] = freeSpace[i].slice(fileBlocks.length);

                break;
            }
        }
    }

    return compactedMemory;
}

function groupByFiles(memory: string[]) : [Map<number, number[]>, number[][]] {
    const files = new Map<number, number[]>();
    const freeSpace : number[][] = [];

    let currentFreeSpaceSlot = [];
    for (let i = memory.length - 1; i >= 0; i--) {
        if (memory[i] === '.') {
            // Collect index of free memory block to the current consecutively slot
            currentFreeSpaceSlot.push(i);
            continue;
        }

        if (currentFreeSpaceSlot.length > 0) {
            // Close the current consecutively free memory slot
            freeSpace.push(currentFreeSpaceSlot.reverse());
            currentFreeSpaceSlot = [];
        }

        // Group by fileId
        files.get(+memory[i])?.push(i) || files.set(+memory[i], [i]);
    }

    return [files, freeSpace.reverse()];
}