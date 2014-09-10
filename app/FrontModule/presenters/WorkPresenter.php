<?php

namespace Mov\FrontModule\Presenters;

use Nette\Application\UI\Form;
/**
 * Work senter.
 */
class WorkPresenter extends BasePresenter
{
		public function actionredict()
	{
        $this->flashMessage('Tato stránka se připravuje','info');
		$this->redirect('Homepage:Default');
	}
public function startup()
	{
		parent::startup();
        $this->flashMessage('Tato stránka se připravuje .','info');
		        $this->flashMessage('Nepodařilo se načíst stránku !','error');
		$this->redirect('Homepage:Default');
	}

}