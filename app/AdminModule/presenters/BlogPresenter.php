<?php

namespace  Mov\AdminModule\Presenters;

use \Nette\Application\UI\Form;


class BlogPresenter extends BasePresenter {
        
	public function renderDefault() {
        $this->template->posts = $this->articleModel->fetchAll();
        }

	protected function createComponentPostForm()
	{

		$form = new Form;
		$form->addText('title', 'Nadpis:')
			->setRequired();
		$form->addTextArea('body', 'Text:')
			->setRequired();

		$form->addSubmit('send', 'Uložit a publikovat');
		$form->onSuccess[] = $this->postFormSucceeded;

		return $form;
	}
public function postFormSucceeded(Form $form)
	{
		$values = $form->getValues();
		$postId = $this->getParameter('postId');

		if ($postId) {
			$post = $this->articleModel->fetchAll()->get($postId);
			$post->update($values);
		} else {
			$post = $this->articleModel->fetchAll()->insert($values);
		}

		$this->flashMessage('Článek byl aktulizován !', 'success');
		$this->redirect('Blog:default');
	}
	public function actionCreate()
	{
		if (!$this->user->isLoggedIn()) {
			$this->redirect('Sign:in');
		}
	}
		public function startup()
	{
			parent::startup();
		$user = $this->getUser();
		if (!$user->isLoggedIn() && !$this->presenter->isLinkCurrent(":Front:Homepage:default")) {
			$this->flashMessage('Nejdříve se musíte přihlásit !','info');
			$this->redirect("Homepage:default");}
        if ($user->isInRole('helpdesk')){
						$this->flashMessage('Na tuto stránku nemáte práva .','error');
			$this->redirect("Homepage:default");
			}
				}
}