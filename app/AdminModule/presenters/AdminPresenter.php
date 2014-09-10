<?php
/**
 * Author: Jaroslav Klimčík
 * Date: 8.6.14
 * Website: http://jerryklimcik.cz
 */

namespace  Mov\AdminModule\Presenters;

use Nette\Application\UI,
	Nette\Application\UI\Form as Form;


class AdminPresenter extends BasePresenter {
   protected function createComponentTestForm()
    {
        $form = new Form;
        $form->addText( 'naseptavac', 'Text:' );
 
        $form->addSubmit( 'send', 'Uložit' );
        $form->onSuccess[] = $this->testFomrSucceeded;
 
        return $form;
    }
 
    public function testFomrSucceeded( $form )
    {
        $this->redirect( "this" );
    } 
}