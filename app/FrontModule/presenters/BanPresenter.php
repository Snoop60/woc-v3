<?php
namespace  Mov\FrontModule\Presenters;

use Nette;
/**
 * Base presenter for all application presenters.
 */
class BanPresenter extends \BasePresenter
{
public function actionOut()
	{
		$this->getUser()->logout();
        $this->flashMessage('Úspěšně odhlášen !','success');
		$this->redirect ('homepage:default');
	}

}
