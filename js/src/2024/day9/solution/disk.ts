export function diskMapToMemory(diskMap: string): string[] {
    let memoryBlocks : string[] = [];

    for (let i = 0, fileId = 0; i < diskMap.length; i = i + 2, fileId++) {
        const fileBlocks = +diskMap[i];
        const freeBlocks = +diskMap[i + 1];

        for (let n = 0; n < fileBlocks; n++) {
            memoryBlocks.push(fileId.toString(10));
        }

        for (let n = 0; n < freeBlocks; n++) {
            memoryBlocks.push('.');
        }
    }

    return memoryBlocks;
}