<?php

namespace Mov\FrontModule\Presenters;

use Nette\Application\UI\Form;
/**
 * Page senter.
 */
class PanelPresenter extends BasePresenter
{
      
		public function startup()
	{
		parent::startup();
		$user = $this->getUser();
		if (!$user->isLoggedIn() && !$this->presenter->isLinkCurrent(":Front:Homepage:default")) {
			$this->flashMessage('Pro tuto stránku se musíte přihlásit ! ','info');
			$this->redirect(":Front:Homepage:default");
			}
	}
		
        public function renderDefault() {
        $this->template->users = $this->userModel->fetchAll();
        }	
			public function actionmap ()
	{
		parent::startup();
        $this->flashMessage('Mapy nejsou k dispozici .','info');
				$this->redirect('Homepage:Default');
	}
}
