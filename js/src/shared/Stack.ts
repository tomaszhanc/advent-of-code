export class Stack<T> {
    private items: T[] = [];

    public push(item: T): void {
        this.items.push(item);
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