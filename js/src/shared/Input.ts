import fs from 'fs';
import path from 'path';

export class Input {
    private readonly data: string

    constructor (data: string) {
        this.data = data.trim();
    }

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
