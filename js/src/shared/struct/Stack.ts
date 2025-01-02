export class Stack<T> {
    private items: T[] = [];

    public push(...items: T[]): void {
        this.items.push(...items);
    }

    public pop(): T {
        if (this.isEmpty()) {
            throw new Error('Stack is empty');
        }

        return this.items.pop()!;
    }

    public isEmpty(): boolean {
        return this.items.length === 0;
    }

    public size(): number {
        return this.items.length;
    }
}