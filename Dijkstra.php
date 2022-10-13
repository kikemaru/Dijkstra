<?php
include_once './DijkstraInterface.php';

class Dijkstra implements DijkstraInterface
{


    private const INFINITY = 1e9;

    /**
     * @var Graph
     */
    private $graph;

    /**
     * @var array
     */
    private $used = []; //Список вершин, в которых уже были

    /**
     * @var array
     */
    private $esum = []; //Накопленные суммы

    /**
     * @var array
     */
    private $path = [];


    /**
     * @param Graph $graph
     */
    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }


    /**
     * @param string $frNode
     * @param string $toNode
     * @return string
     */
    public function getShortestPath(string $frNode, string $toNode): string
    {
        $this->init();
        $this->esum[$frNode] = 0;
        while ($currNode = $this->findNearestUnusedNode())
            $this->setEsumToNextNodes($currNode);
        return $this->restorePath($frNode, $toNode);
    }


    /**
     * @return void
     */
    function init(): void
    {
        foreach ($this->graph->getNodes() as $node) {
            $this->used[$node] = false;
            $this->esum[$node] = self::INFINITY;
            $this->path[$node] = '';
        }
    }


    /**
     * @return string
     */
    function findNearestUnusedNode(): string
    {
        $nearestNode = '';
        foreach ($this->graph->getNodes() as $node) {
            if (!$this->used[$node])
                if ($nearestNode == '' ||
                    $this->esum[$node] < $this->esum[$nearestNode])
                    $nearestNode = $node;
        }
        return $nearestNode;
    }


    /**
     * @param string $currNode
     * @return void
     */
    function setEsumToNextNodes(string $currNode): void
    {
        $this->used[$currNode] = true;
        foreach ($this->graph->getEdges($currNode) as $nextNode => $lenght)
            if (!$this->used[$nextNode])
            {
                $newEsum = $this->esum[$currNode] + $lenght;
                if ($newEsum < $this->esum[$nextNode])
                {
                    $this->esum[$nextNode] = $newEsum;
                    $this->path[$nextNode] = $currNode;

                }
            }

    }


    /**
     * @param string $frNode
     * @param string $toNode
     * @return string
     */
    function restorePath(string $frNode, string $toNode): string
    {
        $path = $toNode;
        while ($toNode != $frNode)
        {
            $toNode = $this->path[$toNode];
            $path = $toNode . $path;

        }
        return $path;
    }
}