<?php

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class SearchAction extends Action {

	/**
	 * Construit la liste des sondages dont la question contient le mot clé
	 * contenu dans la variable $_POST["keyword"]. Cette liste est stockée dans un modèle
	 * de type "SurveysModel". L'utilisateur est ensuite dirigé vers la vue "ServeysView"
	 * permettant d'afficher les sondages.
	 *
	 * Si la variable $_POST["keyword"] est "vide", le message "Vous devez entrer un mot clé
	 * avant de lancer la recherche." est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
	    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
	    
	    if (empty($keyword)){
	        $this->setModel(new MessageModel());
	        $this->getModel()->setMessage('Vous devez entrer un mot cl� avant de lancer la recherche.');
	        $this->getModel()->setLogin($this->getSessionLogin());
	        $this->setView(getViewByName('Message'));
	        return;
	    }
	    
	    //r�cup�rer les sondages dont la question contient le mot cl�
	    $surveys = $this->database->loadSurveysByKeyword($keyword);
	    if ($surveys === false){
	        $this->setModel(new MessageModel());
	        $this->getModel->setMessage('Erreur dans la recherche');
	        $this->getModel()->setLogin($this->getSessionLogin());
	        $this->setView(getViewByName('Message'));
	        return;
	    }
	    
	    $this->setModel(new SurveysModel());
	    $this->getModel()->setSurveys($surveys);
	    $this->getModel()->setLogin($this->getSessionLogin());
	    $this->setView(getViewByName('Surveys'));
	}

}

?>
