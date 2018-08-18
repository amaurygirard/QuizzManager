<?php

  class Question extends DB {

    protected $id;
    protected $text;
    protected $reponses = array();
    protected $image;

    public function __construct($id) {

      $this->setId($id);

      $data = $this->db_select("SELECT * FROM question WHERE id = '". $id ."'");

      $this->text = $data[0]['text'];

      // Recherche les réponses en BDD
      $queryReponses = $this->queryReponses();

      foreach($queryReponses as $reponse_id) {
        $this->addReponse( new Reponse($reponse_id) );
      }

    }

    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
      return $this;
    }

    public function getText() {
      return $this->text;
    }

    public function setText($text) {
      $this->text = $text;
      return $this;
    }

    public function getReponses() {
      return $this->reponses;
    }

    public function setReponses(array $reponses) {
      $this->reponses = $reponses;
      return $this;
    }

    public function addReponse(Reponse $reponse) {
      array_push($this->reponses, $reponse);
      return $this;
    }

    public function queryReponses() {
        $query = $this->db_select("SELECT id FROM reponse WHERE question_id = '".$this->id."'");

        $reponses_ids = array();

        foreach($query as $resultLine) {
            array_push($reponses_ids, $resultLine['id']);
        }
        return $reponses_ids;
    }

    public function getAsArray() {

      $reponses_array = array();

      foreach($this->reponses as $reponse) {
        array_push($reponses_array, $reponse->getAsArray());
      }

      return array(
        'id' => $this->id,
        'text' => $this->text,
        'reponses' => $reponses_array,
      );

    }

  }
