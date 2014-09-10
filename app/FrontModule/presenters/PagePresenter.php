<?php

namespace Mov\FrontModule\Presenters;

use Nette\Application\UI\Form;
/**
 * Page senter.
 */
class PagePresenter extends BasePresenter
{
		public function actionredict()
	{
        $this->flashMessage('Tato stránka se připravuje','info');
		$this->redirect('Homepage:Default');
	}
			
	public function actionerror ()
	{
		parent::startup();
        $this->flashMessage('Tato stránka není k dispozici .','error');
				$this->redirect('Homepage:Default');
	}
		public function actionadmin ()
	{
		parent::startup();
        $this->flashMessage('Úspěšně přesměrován zpět na webové stránky .','success');
				$this->redirect('Homepage:Default');
	}
	
		public function startup()
	{
		parent::startup();
		$user = $this->getUser();
		if ($user->isInRole('ban'))
			{
			$this->redirect(":Front:Ban:Default");
		}
	}
	}