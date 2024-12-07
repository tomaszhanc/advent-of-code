import fs from 'fs';
import path from 'path';

export class Input {
    constructor (
        private readonly data: string
    ) {}

    lines(): string[] {
        return this.data.split('\n');
    }

    content(): string {
        return this.data;
    }
}

export const readPuzzleInput = (relativePath: string): Input => {
    const filePath = path.resolve(__dirname, `../../../resources/${relativePath}`);

    return new Input(fs.readFileSync(filePath, 'utf-8').trim());
};
