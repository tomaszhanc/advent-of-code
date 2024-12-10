export function compactMemory(memory: string[]): string[] {
    let compactedMemory = Array.from(memory);

    for (let freeBlockIdx of freeBlocksToCompact(compactedMemory)) {
        let lastFileBlockIdx = lastFileBlockIndex(compactedMemory);

         // Stop compacting
        if (freeBlockIdx > lastFileBlockIdx) {
            break;
        }

        // Swap free block and last file block
        compactedMemory[freeBlockIdx] = memory[lastFileBlockIdx];
        compactedMemory[lastFileBlockIdx] = '.';
    }

    return compactedMemory;
}

export function calculateCheckSum(memoryBlocks: string[]) : number {
    return memoryBlocks.reduce(
        (sum, block, index) => block === '.' ? sum : sum + (+block * index),
        0
    );
}

function freeBlocksToCompact(memoryBlocks: string[]) : number[] {
    const freeBlocksToCompact : number[] = [];

    for (let i = lastFileBlockIndex(memoryBlocks); i >= 0; i--) {
        if (memoryBlocks[i] === '.') {
            freeBlocksToCompact.push(i);
        }
    }

    return freeBlocksToCompact.reverse();
}

function lastFileBlockIndex(memoryBlocks: string[]): number {
    for (let i = memoryBlocks.length - 1; i >= 0; i--) {
        if (memoryBlocks[i] !== '.') {
            return i;
        }
    }

    return -1;
}
