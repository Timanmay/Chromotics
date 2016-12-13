<?php

use CustomFramework\JsonRestManager;

include_once("custom_framework/Database.php");
include_once("custom_framework/JsonRestManager.php");

/**
 * Created by PhpStorm.
 * User: lyriaaw
 * Date: 09/12/16
 * Time: 15:30
 */
class Question {

    private $question;
    private $response;

    /**
     * Question constructor.
     * @param $question
     * @param $response
     */
    public function __construct($question, $response)
    {
        $this->question = $question;
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }






    /*
     *
     */


    public function display() {
        echo "Question : " . $this->question . " - Response : " . $this->response;
    }



    public static function findById($id) {
        echo "Searching for Question with id = " . $id  . "<br>";

        $bdd = Database::getDb();

        $req = $bdd->prepare('SELECT * FROM questions WHERE id = :id');

        $req->execute(array(
            ':id' => $id
        ));

        $dbResponse = $req->fetch();

        $req->closeCursor();
        return JsonRestManager::createObject($dbResponse, Question::class);


    }


    public static function findAll() {
        $questions = array();

        $bdd = Database::getDb();

        $req = $bdd->query('SELECT * FROM questions');

        while ($dbResponse = $req->fetch()) {
            array_push($questions, JsonRestManager::createObject($dbResponse, Question::class));
        }

        $req->closeCursor();

        return $questions;
    }










}