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


    /**
     * @param string $node
     * @return void
     */
    public function addNode(string $node)
    {
        $this->edges[$node] = [];
    }


    /**
     * @param string $node1
     * @param string $node2
     * @param string $lenght
     * @return void
     */
    public function addEdge(string $node1, string $node2, string $lenght)
    {
        $this->edges[$node1][$node2] = $lenght;
        $this->edges[$node2][$node1] = $lenght;
    }


    /**
     * @return iterable
     */
    public function getNodes(): iterable
    {
        foreach ($this->edges as $node => $edge)
            yield $node;
    }


    /**
     * @param string $node1
     * @return iterable
     */
    public function getEdges(string $node1): iterable
    {
        foreach ($this->edges[$node1] as $node2 => $lenght)
            yield $node2 => $lenght;
    }
}