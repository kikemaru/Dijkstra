<?php

interface DijkstraInterface
{
    /**
     * @param Graph $graph
     */
    public function __construct(Graph $graph);

    /**
     * @param string $frNode
     * @param string $toNode
     * @return mixed
     */
    public function getShortestPath(string $frNode, string $toNode);

    /**
     * @return mixed
     */
    function init();

    /**
     * @return mixed
     */
    function findNearestUnusedNode();

    /**
     * @param string $currNode
     * @return mixed
     */
    function setEsumToNextNodes(string $currNode);

    /**
     * @param string $frNode
     * @param string $toNode
     * @return mixed
     */
    function restorePath(string $frNode, string $toNode);

}