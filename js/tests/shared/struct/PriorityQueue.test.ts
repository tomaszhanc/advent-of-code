import {describe, expect, it} from "vitest";
import {PriorityQueue} from "../../../src/shared/struct/PriorityQueue";

describe('Priority Queue', () => {
    it('gets the element of the lowest weight', () => {
        const queue = new PriorityQueue();
        queue.enqueue('c', 30);
        queue.enqueue('a', 1);
        queue.enqueue('b', 10);
        queue.enqueue('d', 200);


        expect(queue.dequeue()).toBe('a');
        expect(queue.dequeue()).toBe('b');
        expect(queue.dequeue()).toBe('c');
        expect(queue.dequeue()).toBe('d');
    });
});