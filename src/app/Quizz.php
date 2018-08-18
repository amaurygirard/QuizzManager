<?php

  class Quizz extends DB {

    protected $id;
    protected $title;
    protected $questions = array();

    public function __construct($id) {

      // L'id de l'objet est fourni en paramètre lors de son instanciation
      $this->setId($id);

      // On utilise la méthode héritée de DB pour collecter les données à partir de l'id
      $data = $this->db_select("SELECT * FROM quizz WHERE id = '".$id."'");

      // Traite le résultat de la requête
      $this->setTitle($data[0]['title']);

      // Recherche les questions en BDD
      $queryQuestions = $this->queryQuestions();

      foreach($queryQuestions as $question_id) {
        $this->addQuestion( new Question($question_id) );
      }

    }

    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getTitle() {
      return $this->title;
    }

    public function setTitle($title) {
      $this->title = $title;
    }

    public function getQuestions() {
      return $this->questions;
    }

    public function setQuestions(array $questions) {
      $this->title = $questions;
    }

    public function addQuestion(Question $question) {
      array_push($this->questions, $question);
    }

    public function queryQuestions() {
        $query = $this->db_select("SELECT id FROM question WHERE quizz_id = '".$this->id."'");

        $questions_ids = array();

        foreach($query as $resultLine) {
            array_push($questions_ids, $resultLine['id']);
        }
        return $questions_ids;
    }

    public function getAsArray() {

      $questions_array = array();

      foreach($this->questions as $question) {
        array_push($questions_array, $question->getAsArray());
      }

      return array(

          "title" => $this->title,
          "questions" => $questions_array,

      );

    }

  }
