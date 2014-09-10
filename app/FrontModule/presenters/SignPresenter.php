<?php

namespace  Mov\FrontModule\Presenters;

use Nette,
	Nette\Application\UI\Form;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Form;
		$form->addText('username', 'Uživatelské jméno : ')
			->setRequired('Zadajte Vaše prihlasovacie meno.');

		$form->addPassword('password', 'Heslo : ')
			->setRequired('Zadajte heslo.');

		$form->addCheckbox('remember', 'Pamatovat');

		$form->addSubmit('send', 'Přihlásit');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form)
	{
		$values = $form->getValues();

		if ($values->remember) {
			$this->getUser()->setExpiration('60 minutes', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
						$this->flashMessage('Úspěšně přihlášen ! ','success');
			$this->redirect("Panel:nastenka");
		} catch (\Nette\Security\AuthenticationException $e) {
        $this->flashMessage('Špatný nick nebo heslo !','error');
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
        $this->flashMessage('Úspěšně odhlášen !','success');
		$this->redirect ('homepage:default');
	}
		public function startup()
	{
		parent::startup();
        $user = $this->getUser();
		if ($user->isLoggedIn() && $this->presenter->isLinkCurrent(":Front:Sign:in")) {
			$this->flashMessage('Jste již přihlášen !','error');
			$this->redirect(":Front:Homepage:default");
	}
   }
   
}