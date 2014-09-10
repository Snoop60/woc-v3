<?php

namespace  Mov\AdminModule\Presenters;

use Nette,
    App\Model;

use \Nette\Application\UI\Form;
use Nette\Application\UI;


class SupportPresenter extends BasePresenter {
       
	public function action()
	{
		$this->template->articles = $articles =  $this->articleModel->getArticles();	
		$this->template->count = 1;
	}
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
    $form = new UI\Form();
$name = array(
    'Technická podpora' => 'ano',
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
        $this->flashMessage('Komentář k tiketu byl zaznamenán !' , 'success');
        $this->redirect("this");
    }
   public function createComponentAkceForm() {
    $form = new Form();
$name = array(
    'otevřen' => 'Otevřeno',
    'vyřešen' => 'Vyřešeno',
    'uzavřen' => 'Uzavřeno',
);
$form->addSelect('stav', 'Stav tiketu:', $name);
$form->addTextArea('admin', 'Přiřadit: ')
            ->addRule($form::FILLED, 'Komentář je povinný!');
		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = $this->akceFormSucceeded;
    return $form;
}
	public function actionEdit($ticketId)
	{

		$post = $this->versionModel->tiketAll()->get($ticketId);
		if (!$post) {
			$this->error('Post not found');
		}
		$this['akceForm']->setDefaults($post->toArray());
	}
	public function akceFormSucceeded(Form $form) {
		$values = $form->getValues();
		$ticketId = $this->getParameter('ticketId');
	if ($ticketId) {
			$post = $this->versionModel->tiketAll()->get($ticketId);
			$post->update($values);
		} else {
			$post = $this->versionModel->tiketAll()->insert($values);
		}
			$this->flashMessage('Tiket byl upraven !', 'success');
			$this->redirect('homepage:default');
		}
        
				
	}

