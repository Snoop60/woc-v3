<?php

namespace  Mov\AdminModule\Presenters;

use \Nette\Application\UI\Form;


class HomepagePresenter extends BasePresenter {
	public function actionCreate()
	{
	}

	protected function createComponentPostForm()
	{

		$form = new Form;
		$form->addText('title', 'Title:')
			->setRequired();
		$form->addTextArea('body', 'Content:')
			->setRequired();

		$form->addSubmit('send', 'Save and publish');
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

		$this->flashMessage('Post was published', 'success');
		$this->redirect('homepage:default');
	}
		public function actionpresmer ()
	{
		parent::startup();
        $this->flashMessage('Vítejte zpět v administrci .','success');
				$this->redirect('Homepage:Default');
	}
			public function actionerror ()
	{
		parent::startup();
        $this->flashMessage('Došlo k chybě ! .','error');
				$this->redirect('Homepage:Default');
	}
}