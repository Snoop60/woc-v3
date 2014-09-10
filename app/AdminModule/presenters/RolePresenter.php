<?php

namespace  Mov\AdminModule\Presenters;

use \Nette\Application\UI\Form;


class RolePresenter extends BasePresenter {
       
        public function renderDefault() {
        $this->template->users = $this->userModel->fetchAll();
        }	
	protected function createComponentUserForm()
	{		
		$form = new Form;
$role = array(
	'hrac' => 'Hráč',
	'helpdesk' => 'HelpDesk',
	'member' => 'Member',
	'admin' => 'Admin',
	'superadmin' => 'superadmin',
	'ban' => 'ban',
);
$form->addRadioList('role', 'Role:', $role);
		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = $this->userFormSucceeded;

		return $form;
	}

	public function actionEdit($userId)
	{

		$user = $this->userModel->fetchAll()->get($userId);
		if (!$user) {
			$this->error('NOP');
		}
		$this['userForm']->setDefaults($user->toArray());
	}
	public function userFormSucceeded(Form $form) {
		$values = $form->getValues();
		$userId = $this->getParameter('userId');
	if ($userId) {
			$user = $this->userModel->fetchAll()->get($userId);
			$user->update($values);
		} else {
			$user = $this->userModel->fetchAll()->insert($values);
		}
			$this->flashMessage('Role byla změněna !', 'success');
			$this->redirect('homepage:default');
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
					if ($user->isInRole('admin')){
						$this->flashMessage('Na tuto stránku nemáte práva .','error');
			$this->redirect("Homepage:default");
			}
				}
	}
	
