<?php
/**
 * Author: Jaroslav Klimčík
 * Date: 8.6.14
 * Website: http://jerryklimcik.cz
 */

namespace  Mov\AdminModule\Presenters;


class BasePresenter extends \BasePresenter {

    public function beforeRender() {
        $this->setLayout('layoutAdmin');
    }
		public function startup()
	{
			parent::startup();
		$user = $this->getUser();
		if (!$user->isLoggedIn() && !$this->presenter->isLinkCurrent(":Front:Homepage:default")) {
			$this->flashMessage('Nejdříve se musíte přihlásit !','info');
			$this->redirect(":Front:Homepage:default");
			}
		if (!$user->isInRole('superadmin')){
		}
		if (!$user->isInRole('admin')){
		}
		if (!$user->isInRole('member')){
			}
        if (!$user->isInRole('helpdesk')){
			}
		if ($user->isInRole('ban')){
			$this->redirect(":Front:Homepage:default");
			}
				if ($user->isInRole('hrac')){
			$this->flashMessage('Nedostatečná oprávnění !','error');
			$this->redirect(":Front:Homepage:default");
			}
				}

    public function handleLogOut() {
        $this->user->logout();
        $this->flashMessage('Byl jste odhlášen', 'info');
        $this->redirect(':Front:Homepage:default');

    }

}