<?php

namespace  Mov\AdminModule\Presenters;

use \Nette\Application\UI\Form;


class CreditPresenter extends BasePresenter {
       
        public function renderDefault() {
        $this->template->users = $this->userModel->fetchAll();
        }	
	protected function createComponentCreditForm()
	{		
		$form = new Form;
		$form->addTextArea('balance', 'Kredit :');
		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = $this->creditFormSucceeded;

		return $form;
	}

	public function actionEdit($userId)
	{

		$post = $this->userModel->fetchAll()->get($userId);
		if (!$post) {
			$this->error('Post not found');
		}
		$this['creditForm']->setDefaults($post->toArray());
	}
	public function creditFormSucceeded(Form $form) {
		$values = $form->getValues();
		$userId = $this->getParameter('userId');
	if ($userId) {
			$post = $this->userModel->fetchAll()->get($userId);
			$post->update($values);
		} else {
			$post = $this->userModel->fetchAll()->insert($values);
		}
			$this->flashMessage('Kreditoví stav byl upraven !', 'success');
			$this->redirect('credit:default');
		}
					public function startup()
	{
			parent::startup();
					$user = $this->getUser();
        if ($user->isInRole('helpdesk')){
						$this->flashMessage('Na tuto stránku nemáte práva .','error');
			$this->redirect("Homepage:default");
			}
		if ($user->isInRole('member')){
						$this->flashMessage('Na tuto stránku nemáte práva .','error');
			$this->redirect("Homepage:default");
			}
				}
	}
	
	
