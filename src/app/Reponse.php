<?php

  class Reponse extends DB {

    protected $id;
    protected $text;
    protected $is_correct;

    public function __construct($id) {

      $this->setId($id);

      $data = $this->db_select("SELECT * FROM reponse WHERE id = '". $id ."'");

      $this->text = $data[0]['text'];
      $this->is_correct = $data[0]['correct'];

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

    public function getAsArray() {

      return array(
        'id' => $this->id,
        'text' => $this->text,
        'is_correct' => $this->is_correct,
      );

    }

  }
