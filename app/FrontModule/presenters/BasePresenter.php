<?php
namespace  Mov\FrontModule\Presenters;

use Nette;
/**
 * Base presenter for all application presenters.
 */
class BasePresenter extends \BasePresenter
{
	public function startup()
	{
		parent::startup();
		$user = $this->getUser();
		if ($user->isInRole('ban'))
			{
			$this->redirect(":Front:Ban:Default");
		}
	}
        public function actionOut()
	{
		$this->getUser()->logout();
        $this->flashMessage('Úspěšně odhlášen !','success');
		$this->redirect ('homepage:default');
	}

}
