import {describe, expect, it} from "vitest";
import {PriorityQueue} from "../../../src/shared/struct/PriorityQueue";

describe('Priority Queue', () => {
    it('gets the element of the lowest weight', () => {
        const queue = new PriorityQueue<{value: string, score: number}>();
        queue.enqueue({ value: 'c', score: 30  });
        queue.enqueue({ value: 'a', score: 1   });
        queue.enqueue({ value: 'b', score: 10  });
        queue.enqueue({ value: 'd', score: 200 });


        expect(queue.dequeue().value).toBe('a');
        expect(queue.dequeue().value).toBe('b');
        expect(queue.dequeue().value).toBe('c');
        expect(queue.dequeue().value).toBe('d');
    });
});