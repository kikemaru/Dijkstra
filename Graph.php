<?php

class Graph
{
    /** @var array */
    private $edges;
    // матрица смежности вершин :
    //$edges['A']['B'] = 12; //lenght
    // $edges['B']['A'] = 12;

    public function __construct()
    {
        $this->edges = [];
    }

    public function addNode(string $node)
    {
        $this->edges[$node] = [];
    }

    public function addEdge(string $node1, string $node2, string $lenght)
    {
        $this->edges[$node1][$node2] = $lenght;
        $this->edges[$node2][$node1] = $lenght;
    }

    public function getNodes(): iterable
    {
        foreach ($this->edges as $node => $edge)
            yield $node;
    }

    public function getEdges(string $node1): iterable
    {
        foreach ($this->edges[$node1] as $node2 => $lenght)
            yield $node2 => $lenght;
    }
}