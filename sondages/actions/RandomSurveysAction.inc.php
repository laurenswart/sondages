<?php

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class RandomSurveysAction extends Action {

	/**
	 * R�cup�re 3 sondages au hasard dans la base de donn�es � l'aide de la m�thode getRandomSurveys($nb) 
	 * de la classe Database.
	 * Donner ces sondages au mod�le SurveysModel et afficher avec la vue SurveysVue
	 *
	 * @see Action::run()
	 */
	public function run() {
	    $surveys = $this->database->getRandomSurveys(3);
	    
	    if($surveys === false ){
	        $model = new MessageModel();
	        $model->setMessage("Une erreur c'est produite");
	        $this->setView(getViewByName('Message'));
	    } else {
	        $model = new SurveysModel();
	        $model->setSurveys($surveys);
	        $this->setView(getViewByName('RandomThree'));
	    }
	    $this->setModel($model);
	}

}

?>
