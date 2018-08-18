<?php

  /* Définit l'utf-8 pour le document */
  header('Content-Type: text/html; charset=utf-8');

  /* Chargement de l'application */
  require('app/autoload.php');


  /* Instancie le Quizz demandé à partir de l'id transmise */

  if(isset($_GET['quizz_id']) && !empty($_GET['quizz_id'])) {

    $quizz = new Quizz($_GET['quizz_id']);

  }
  else {

    die('Paramètre de requête non-valide');

  }

  echo json_encode($quizz->getAsArray());
