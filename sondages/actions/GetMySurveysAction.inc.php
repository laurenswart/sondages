<?php

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class GetMySurveysAction extends Action {

	/**
	 * Construit la liste des sondages de l'utilisateur dans un mod�le
	 * de type "SurveysModel" et le dirige vers la vue "ServeysView" 
	 * permettant d'afficher les sondages.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * @see Action::run()
	 */
	public function run() {

		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez �tre authentifi�.");
			return;
		}

		$surveys = $this->database->loadSurveysByOwner($this->getSessionLogin());
		
		if ($surveys === false ){
		  $model = new MessageModel();
		  $model->setMessage("Une erreur s'est produite");
		  
		  $this->setView(getViewByName("Message"));
		} else {
		  $model = new SurveysModel();
		  $model->setSurveys($surveys);
		  $this->setView(getViewByName('Surveys'));
		}
		$model->setLogin($this->getSessionLogin());
		$this->setModel($model);
	}

}

?>
