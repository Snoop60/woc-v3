<?php


namespace  Mov\FrontModule\Presenters;

use Nette\Application\UI,
	Nette\Application\UI\Form as Form;
/**
 * Register in/out presenters.
 */
class RegisterPresenter extends BasePresenter {

    protected function createComponentRegisterForm() {
        $form = new Form;
        $form->addText('name', 'Jméno a Přímení: *');
		$form->addText('username', 'Uživatelské jméno: *', 35)
                ->addRule(Form::PATTERN, 'co to napise', '[a-žA-Ž0-9]+');
        $form->addText('email', 'E-mail: *', 35)
                ->setEmptyValue('@')
                ->addRule(Form::FILLED, 'Vyplňte Váš email')
                ->addCondition(Form::FILLED)
                ->addRule(Form::EMAIL, 'Neplatná emailová adresa');
        $form->addPassword('password', 'Heslo: *', 20)
                ->setOption('description', 'Alespoň 6 znaků')
                ->addRule(Form::FILLED, 'Vyplňte Vaše heslo')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 6);
        $form->addPassword('password2', 'Heslo znovu: *', 20)
                ->addConditionOn($form['password'], Form::VALID)
                ->addRule(Form::FILLED, 'Heslo znovu')
                ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['password']);
		$form->addProtection('Vypršel časový limit, odešlete formulář znovu');
        $form->addSubmit('send', 'Registrovat');
        $form->onSuccess[] = callback($this, 'registerFormSubmitted');
        return $form;
    }

    public function registerFormSubmitted(UI\Form $form) {
        $values = $form->getValues();
        $this->userModel->register($values);

            $this->flashMessage('Váš účet byl úspěšně zaregistrován !','succes');
            $this->redirect('Sign:in');
        }
}
