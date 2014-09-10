<?php

namespace Mov\FrontModule\Presenters;
use Nette,
    App\Model;

use \Nette\Application\UI\Form;
use Nette\Application\UI;
/**
 * Page senter.
 */
class SupportPresenter extends BasePresenter
{
        public function renderDefault() {
        $this->template->tikets = $this->versionModel->tiketAll();
        }
  public function renderShow($id) {
        if (!($tikets = $this->versionModel->fetchSingle($id))) {
            $this->error('Článek nebyl nalezen'); //pokud clanek neexistuje, presmerujeme uzivatele
        }
        $this->template->tikets = $tikets;
        $this->template->comments = $this->commentsModel->fetchArticleComments($id);
    } 
public function createComponentCommentForm() {
	$user = $this->getUser();
    $form = new UI\Form();
$name = array(
    ($user->identity->username) => 'ano',
);
$form->addRadioList('author', 'Potvrzujete odeslání ? :', $name)
            ->addRule($form::FILLED, 'Komentář je povinný!');
    $form->addTextArea('body', 'Komentář: ')
            ->addRule($form::FILLED, 'Komentář je povinný!');
    $form->addSubmit('send', 'Odeslat');
    $form->onSuccess[] = callback($this, 'commentFormSubmitted');
    return $form;
}
 
     public function commentFormSubmitted(UI\Form $form) {
        $data = $form->getValues();
        $data['date'] = new \DateTime();
        $data['post_id'] = (int)$this->getParam('id');
        $id = $this->commentsModel->insert($data);
        $this->flashMessage('Komentář uložen!');
        $this->redirect("this");
    }
		public function actionEdit($postId)
	{
		$post = $this->articleModel->fetchAll()->get($postId);
		if (!$post) {
			$this->error('Post not found');
		}
		$this['postForm']->setDefaults($post->toArray());
	}
    	protected function createComponentTicketForm()
	{
                $user = $this->getUser();
		$form = new Form;
 
		$form->addText('title', 'Nadpis:')
			->setRequired();
		$form->addTextArea('body', 'Text:')
			->setRequired();
                               $name = array(
    ($user->identity->username) => 'ano',
);
$form->addRadioList('author', 'Potvrzujete odeslání ? :', $name)
            ->addRule($form::FILLED, 'Komentář je povinný!');

		$form->addSubmit('send', 'Uložit a publikovat');
		$form->onSuccess[] = $this->ticketFormSucceeded;

		return $form;
	}
public function ticketFormSucceeded(Form $form)
	{
		$values = $form->getValues();
		$ticketId = $this->getParameter('ticketId');

		if ($ticketId) {
			$post = $this->versionModel->tiketAll()->get($ticketId);
			$post->update($values);
		} else {
			$post = $this->versionModel->tiketAll()->insert($values);
		}

		$this->flashMessage('Ticket byl přidan.', 'success');
		$this->redirect('Support:default');
	}
			public function startup ()
	{
		parent::startup();
               $user = $this->getUser();
		if (!$user->isLoggedIn() && !$this->presenter->isLinkCurrent(":Front:Homepage:default")) {
			$this->flashMessage('Pro tuto stránku se musíte přihlásit ! ','info');
			$this->redirect(":Front:Homepage:default");
			}
	}
}