type Type = { score: number } | { weight: number };
type Item<T extends Type> = [T, number];

export class PriorityQueue<T extends Type> {
    private items: Item<T>[] = [];

    public enqueue(item: T): void {
        const weight = 'score' in item ? item.score : item.weight;

        this.items.push([item, weight]);
        this.items.sort((a, b) => b[1] - a[1]);
    }

    public dequeue(): T {
        if (this.isEmpty()) {
            throw new Error('Queue is empty');
        }

        return this.items.pop()![0];
    }

    public isEmpty(): boolean {
        return this.items.length === 0;
    }

    public size(): number {
        return this.items.length;
    }
}