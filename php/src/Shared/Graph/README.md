# Basic Terms in Graph Theory

### 1. **Graph**
A graph is a collection of **nodes** (or **vertices**) and **edges** (or **arcs**) that connect pairs of nodes. It represents relationships between entities.

### 2. **Node (Vertices)**
A **node** is a fundamental unit in a graph. It represents a point or an entity, such as a city in a map or a person in a social network.

### 3. **Edge (Arc)**
An **edge** (or **arc**) is a connection between two nodes. It represents a relationship between the two entities. Edges can be **directed** or **undirected**.

### 4. **Directed Graph (Digraph)**
A **directed graph** (or **digraph**) is a graph where the edges have a direction, meaning they go from one node to another (indicated by arrows).

### 5. **Undirected Graph**
An **undirected graph** is a graph where the edges do not have a direction. The relationship between nodes is mutual (e.g., a friendship between two people).

### 6. **Weighted Graph**
A **weighted graph** is a graph where each edge has a weight (or cost) associated with it. This weight could represent distance, cost, or capacity.

### 7. **Adjacency**
Two nodes are **adjacent** if they are connected by an edge. In a directed graph, an edge from node A to node B means that A is adjacent to B.

### 8. **Adjacency List**
An **adjacency list** is a way to represent a graph. For each node, it stores a list of adjacent nodes (those directly connected by an edge).

### 9. **Adjacency Matrix**
An **adjacency matrix** is a square matrix used to represent a graph. The matrix entries indicate whether pairs of nodes are adjacent or not in the graph.

### 10. **Degree**
The **degree** of a node is the number of edges incident to it. In a directed graph, this can be split into **in-degree** (number of incoming edges) and **out-degree** (number of outgoing edges).

### 11. **Path**
A **path** in a graph is a sequence of nodes connected by edges. A **simple path** does not repeat any node.

### 12. **Cycle**
A **cycle** is a path that starts and ends at the same node, with no repeated edges or nodes except for the start/end node.

### 13. **Connected Graph**
A graph is **connected** if there is a path between every pair of nodes. In an undirected graph, if any two nodes are disconnected, the graph is not connected.

### 14. **Component**
A **component** is a connected subgraph of a graph. If a graph is not connected, it consists of multiple components.

### 15. **Subgraph**
A **subgraph** is a graph formed from a subset of the nodes and edges of a graph.

### 16. **Tree**
A **tree** is a type of graph that is connected and acyclic. It has no cycles, and there is exactly one path between any two nodes.

### 17. **Spanning Tree**
A **spanning tree** of a graph is a subgraph that includes all the nodes of the graph, connected by a subset of the edges, and is a tree (i.e., no cycles).

### 18. **Bipartite Graph**
A **bipartite graph** is a graph where the nodes can be divided into two disjoint sets such that every edge connects a node from one set to a node in the other set.

### 19. **Directed Acyclic Graph (DAG)**
A **directed acyclic graph (DAG)** is a directed graph that has no cycles. This means there is no path from a node back to itself.

### 20. **Clique**
A **clique** in a graph is a subset of nodes such that every two distinct nodes in the clique are adjacent.

### 21. **Shortest Path**
The **shortest path** between two nodes is the path with the smallest total weight (in a weighted graph) or the fewest edges (in an unweighted graph) connecting them.

### 22. **Distance**
The **distance** between two nodes in a graph is the number of edges in the shortest path connecting them. In weighted graphs, it refers to the sum of the edge weights in the shortest path.

### 23. **Neighbor**
A **neighbor** of a node is a node that is adjacent to it, meaning there is an edge connecting the two.

### 24. **Isolated Node**
An **isolated node** is a node that has no edges connecting it to any other node in the graph.

### 25. **Walk**
A **walk** is a sequence of nodes and edges where each edge’s endpoints are consecutive nodes in the sequence, but unlike a path, nodes and edges can repeat.

### 26. **Eulerian Path**
An **Eulerian path** is a path that uses every edge in the graph exactly once. If the graph is connected and all nodes have even degree, the graph has an Eulerian circuit (a closed Eulerian path).

### 27. **Hamiltonian Path**
A **Hamiltonian path** is a path in a graph that visits each node exactly once. If it starts and ends at the same node, it is called a **Hamiltonian cycle**.
