<?php

class Router {


    private $currentAddress; // The adress of the server
    private $baseDirection; // The redirection destination when there is no destination specified


    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->currentAddress = $_SERVER["SERVER_ADDR"] . ":" . $_SERVER["SERVER_PORT"];
        $this->baseDirection = "connection";
    }


    /**
     * Verify if the "dest" attribute is set and redirect to a destination
     */
    public function manageDestinationMission() {
        if (!isset($_GET['dest'])){
            header("Location: http://" . $this->currentAddress . "?dest=" . $this->baseDirection);
        }
    }



    public function getRoute() {
        $destination = $_GET['dest'];




        return $destination . "/";
    }



    public function createUrl($destination) {
        return "http://" . $this->currentAddress . "?dest=" . $destination;
    }


}