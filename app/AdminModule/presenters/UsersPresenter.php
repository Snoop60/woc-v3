<?php

namespace  Mov\AdminModule\Presenters;

use \Nette\Application\UI\Form;


class UsersPresenter extends BasePresenter {
       
        public function renderDefault() {
        $this->template->users = $this->userModel->fetchAll();
        }	
	protected function createComponentPostForm()
	{		
		$form = new Form;
		$form->addTextArea('name', 'Jméno :')
			->setRequired();
        $form->addText('email', 'E-mail: *', 35)
                ->setEmptyValue('@')
                ->addRule(Form::FILLED, 'Vyplňte Váš email')
                ->addCondition(Form::FILLED)
                ->addRule(Form::EMAIL, 'Neplatná emailová adresa');
		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = $this->postFormSucceeded;

		return $form;
	}

	public function actionEdit($userId)
	{

		$post = $this->userModel->fetchAll()->get($userId);
		if (!$post) {
			$this->error('Post not found');
		}
		$this['postForm']->setDefaults($post->toArray());
	}
	public function postFormSucceeded(Form $form) {
		$values = $form->getValues();
		$userId = $this->getParameter('userId');
	if ($userId) {
			$post = $this->userModel->fetchAll()->get($userId);
			$post->update($values);
		} else {
			$post = $this->userModel->fetchAll()->insert($values);
		}
			$this->flashMessage('Účet byl úspěšně upraven !', 'success');
			$this->redirect('users:default');
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
	