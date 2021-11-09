<?php
require_once("views/View.inc.php");

class RandomThreeView extends View {

	/**
	 * Affiche la liste de 3 sondages pr�sents dans le mod�le pass�e en param�tre.
	 * 
	 * Le mod�le pass� en param�tre est une instance de la classe 'SurveysModel'.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody($model) {

		if (count($model->getSurveys())===0) {
			echo "Aucun sondage ne correspond à votre recherche.";
			return;
		}

		foreach ($model->getSurveys() as $survey) {
			$survey->computePercentages();
			require("templates/survey.inc.php");
		}
	}
	
	/**
	 * G�n�re une page sp�cifique � l'affichage de 3 sondages al�atoires
	 * 
	 * @param Model $model repr�sente les donn�es � afficher
	 * 
	 * {@inheritDoc}
	 * @see View::run()
	 */
	public function run($model){
	    $login = $model->getLogin();
	    $surveys = $model->getSurveys();
	    require 'templates/randomThree.php';
	}

}
?>
