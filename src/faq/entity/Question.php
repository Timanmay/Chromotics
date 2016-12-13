<?php

include_once("custom_framework/Database.php");

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



    public static function findById($id) {

        $bdd = Database::getDb();

        $req = $bdd->prepare("SELECT * FROM questions WHERE id = :id");
        $req->execute(array(
            'id' => $id
        ));

        $datas = $req->fetch();

        echo "Found question : " . sizeof($datas);




    }










}