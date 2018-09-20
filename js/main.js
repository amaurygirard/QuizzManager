jQuery(document).ready(function(){

  "use strict";


  /* Ajax request to display quizz data */
  jQuery.getJSON('src/index.php?quizz_id=1', function(data){

    /* Build Quizz HTML from JSON object */

    // Title
    jQuery('h1').text(data.title);

    // Questions
    var html;

    if(data.questions.length > 0) {

      for(var i = 0; i < data.questions.length; i++) {

        html = '<article id="question-' + data.questions[i].id + '" class="questions">';

        html += '<h2>' + data.questions[i].text + '</h2>';

        // Answers
        if(data.questions[i].reponses.length > 0) {

          html += '<ol>';

          for(var j = 0; j < data.questions[i].reponses.length; j++) {

            html += '<li><input type="radio" name="question-'+data.questions[i].id+'" value="'+data.questions[i].reponses[j].is_correct+'">' + data.questions[i].reponses[j].text + '</li>';

          }

          html += '</ol>';

        }
        else {
          html += '<p>Aucune réponse n\'a été renseignée pour cette question.</p>';
        }

        html += '</article>';
        jQuery('#questions').append(html);
      }

    }
    else {

      html = '<p>Ce quizz ne comporte encore aucune question.</p>';
      jQuery('#questions').append(html);

    }

    /* Initiate slick to display slider */

    jQuery('#questions').slick();

  });


  /* Check if an answer is the right one */
  function isAnswerCorrect(reponseObject){

    return reponseObject.is_correct;

  }

});
