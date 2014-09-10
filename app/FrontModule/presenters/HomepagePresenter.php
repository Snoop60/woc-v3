<?php

namespace  Mov\FrontModule\Presenters;

use \Nette\Application\UI;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {
	public function action(){
		$this->template->articles = $articles =  $this->articleModel->getArticles();
		$this->template->count = 1;
		}
        public function renderDefault() {
        $this->template->posts = $this->articleModel->fetchAll();
        }
        public function renderShow($id) {
    if (!($post = $this->articleModel->fetchSingle($id))) {
        $this->error('Článek nebyl nalezen'); //pokud clanek neexistuje, presmerujeme uzivatele
		}
	 $this->template->post = $post;
}

}
