export class Queue<T> {
    private items: T[] = [];

    public enqueue(...items: T[]): void {
        this.items.push(...items);
    }

    public dequeue(): T {
        if (this.isEmpty()) {
            throw new Error('Queue is empty');
        }

        return this.items.shift()!;
    }

    public isEmpty(): boolean {
        return this.items.length === 0;
    }

    public size(): number {
        return this.items.length;
    }
}